<?php
namespace App\Controllers\WEB;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\Book;
use App\Models\User;
use App\Models\Order;
use App\Core\Database;

class Admin extends Controller {
    protected $book;
    protected $user;
    protected $order;
    protected $validator;

    public function __construct(Database $db) {
        parent::__construct($db); 
        $this->book = new Book();
        $this->user = new User(); 
        $this->order = new Order($db); 
        $this->validator = new Validator(); 
    }

    public function index() {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }
        
        $book = new Book();
        
        // Get search, category, sort, and pagination parameters
        $keyword = $this->validator->sanitizeInput($this->getRequestParam('search'));
        $category = $this->validator->sanitizeInput($this->getRequestParam('category'));
        $sort = $this->validator->sanitizeInput($this->getRequestParam('sort', 'book_title'));
        $page = intval($this->validator->sanitizeInput($this->getRequestParam('page', 1)));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        if ($keyword) {
            $books = $book->searchBooks($keyword, $limit, $offset);
            $totalBooks = $book->getSearchBooksCount($keyword);
        } elseif ($category) {
            $books = $book->filterBooksByCategory($category, $limit, $offset);
            $totalBooks = $book->getCategoryBooksCount($category);
        } else {
            $books = $book->getAllBooks($limit, $offset);
            $totalBooks = $book->getBooksCount();
        }

        // Fetch all categories for the dropdown
        $categories = $book->fetchAllCategories();

        // Pass data to the view
        $this->view('admin/index', [
            'books' => $books,
            'totalBooks' => $totalBooks,
            'categories' => $categories,
            'currentPage' => $page,
            'limit' => $limit,
            'keyword' => $keyword,
            'category' => $category,
            'sort' => $sort
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $bookTitle = $this->validator->sanitizeInput($_POST['book_title']);
            $bookDescription = $this->validator->sanitizeInput($_POST['book_description']);
            $bookAuthor = $this->validator->sanitizeInput($_POST['book_author']);
            $bookPrice = $this->validator->sanitizeInput($_POST['book_price']);
            $bookGenre = $this->validator->sanitizeInput($_POST['book_genre']);
            $bookImage = $this->validator->sanitizeInput($_POST['book_image']);

            // Validate inputs
            $this->validator->required('book_title', $bookTitle)
                             ->required('book_description', $bookDescription)
                             ->required('book_author', $bookAuthor)
                             ->numeric('book_price', $bookPrice)
                             ->min('book_price', $bookPrice, 0)
                             ->required('book_genre', $bookGenre)
                             ->url('book_image', $bookImage);

            if ($this->validator->fails()) {
                $this->view('admin/create', ['errors' => $this->validator->errors()]);
            } else {
                $book = new Book();
                $book->createBook([
                    'book_title' => $bookTitle,
                    'book_description' => $bookDescription,
                    'book_author' => $bookAuthor,
                    'book_price' => $bookPrice,
                    'book_genre' => $bookGenre,
                    'book_image' => $bookImage
                ]);
                header('Location: /admin');
            }
        } else {
            $this->view('admin/create');
        }
    }

    public function update($id) {
        $book = new Book();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize inputs
            $bookTitle = $this->validator->sanitizeInput($_POST['book_title']);
            $bookDescription = $this->validator->sanitizeInput($_POST['book_description']);
            $bookAuthor = $this->validator->sanitizeInput($_POST['book_author']);
            $bookPrice = $this->validator->sanitizeInput($_POST['book_price']);
            $bookGenre = $this->validator->sanitizeInput($_POST['book_genre']);
            $bookImage = $this->validator->sanitizeInput($_POST['book_image']);

            // Validate inputs
            $this->validator->required('book_title', $bookTitle)
                             ->required('book_description', $bookDescription)
                             ->required('book_author', $bookAuthor)
                             ->numeric('book_price', $bookPrice)
                             ->min('book_price', $bookPrice, 0)
                             ->required('book_genre', $bookGenre)
                             ->url('book_image', $bookImage);

            if ($this->validator->fails()) {
                $book = $book->getBookById($id);
                $this->view('admin/update', ['book' => $book, 'errors' => $this->validator->errors()]);
            } else {
                $book->updateBook([
                    'book_title' => $bookTitle,
                    'book_description' => $bookDescription,
                    'book_author' => $bookAuthor,
                    'book_price' => $bookPrice,
                    'book_genre' => $bookGenre,
                    'book_image' => $bookImage
                ], $id);
                header('Location: /admin');
            }
        } else {
            $book = $book->getBookById($id);
            $this->view('admin/update', ['book' => $book]);
        }
    }

    public function delete($id) {
        $book = new Book();
        $book->deleteBook($id);
        header('Location: /admin');
    }

    // Users management
    public function manageUsers() {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }
        
        $users = $this->user->getAllUsers();
        $this->view('admin/manageUsers', ['users' => $users]);
    }

    public function deleteUser($id) {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }

        $this->user->deleteUser($id);
        header('Location: /admin/manageUsers');
    }

    // Orders management
    public function manageOrders() {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }
        
        $orders = $this->order->getAllOrders(); // Assuming this method exists in Order model
        $this->view('admin/manageOrders', ['orders' => $orders]);
    }

    public function viewOrder($id) {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }

        $order = $this->order->getOrderById($id);
        $this->view('admin/viewOrder', ['order' => $order]);
    }

    public function updateOrderStatus($id) {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view the admin panel.');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $this->validator->sanitizeInput($_POST['status']);
            $this->order->updateOrderStatus($id, $status);
            header('Location: /admin/manageOrders');
        }
    }
}
