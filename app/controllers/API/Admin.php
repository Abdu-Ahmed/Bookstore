<?php
namespace App\Controllers\API;

use App\Core\API\APIController;
use App\Core\Validator;
use App\Models\Book;

class Admin extends APIController {
    protected $book;
    protected $validator;

    public function __construct() {
        $this->book = new Book();
        $this->validator = new Validator(); // Instantiate Validator
    }

    public function index() {
        if (!$this->isLoggedIn()) {
            return $this->jsonResponse(['error' => 'Unauthorized'], 401);
        }

        $keyword = $this->validator->sanitizeInput($this->getRequestParam('search'));
        $category = $this->validator->sanitizeInput($this->getRequestParam('category'));
        $sort = $this->validator->sanitizeInput($this->getRequestParam('sort', 'book_title'));
        $page = (int)$this->validator->sanitizeInput($this->getRequestParam('page', 1));
        $limit = 6;
        $offset = ($page - 1) * $limit;

        if ($keyword) {
            $books = $this->book->searchBooks($keyword, $limit, $offset);
            $totalBooks = $this->book->getSearchBooksCount($keyword);
        } elseif ($category) {
            $books = $this->book->filterBooksByCategory($category, $limit, $offset);
            $totalBooks = $this->book->getCategoryBooksCount($category);
        } else {
            $books = $this->book->getAllBooks($limit, $offset);
            $totalBooks = $this->book->getBooksCount();
        }

        $categories = $this->book->fetchAllCategories();

        return $this->jsonResponse([
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
            $postData = array_map([$this->validator, 'sanitizeInput'], $_POST);

            $this->validator->required('book_title', $postData['book_title'])
                            ->required('book_description', $postData['book_description'])
                            ->required('book_author', $postData['book_author'])
                            ->numeric('book_price', $postData['book_price'])
                            ->min('book_price', $postData['book_price'], 0)
                            ->required('book_genre', $postData['book_genre'])
                            ->url('book_image', $postData['book_image']);

            if ($this->validator->fails()) {
                return $this->jsonResponse(['errors' => $this->validator->errors()], 400);
            }

            $this->book->createBook($postData);
            return $this->jsonResponse(['message' => 'Book created successfully'], 201);
        }

        return $this->jsonResponse(['error' => 'Invalid request method'], 405);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $sanitizedData = array_map([$this->validator, 'sanitizeInput'], $data);

            $this->validator->required('book_title', $sanitizedData['book_title'])
                            ->required('book_description', $sanitizedData['book_description'])
                            ->required('book_author', $sanitizedData['book_author'])
                            ->numeric('book_price', $sanitizedData['book_price'])
                            ->min('book_price', $sanitizedData['book_price'], 0)
                            ->required('book_genre', $sanitizedData['book_genre'])
                            ->url('book_image', $sanitizedData['book_image']);

            if ($this->validator->fails()) {
                return $this->jsonResponse(['errors' => $this->validator->errors()], 400);
            }

            $this->book->updateBook($sanitizedData, $id);
            return $this->jsonResponse(['message' => 'Book updated successfully'], 200);
        }

        return $this->jsonResponse(['error' => 'Invalid request method'], 405);
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $id = $this->validator->sanitizeInput($id);
            $this->book->deleteBook($id);
            return $this->jsonResponse(['message' => 'Book deleted successfully'], 200);
        }

        return $this->jsonResponse(['error' => 'Invalid request method'], 405);
    }
}
