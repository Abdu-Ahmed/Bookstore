<?php
namespace App\Controllers\WEB;

use App\Core\Controller;
use App\Models\Book;
use App\Core\Category;
class Books extends Controller {
    protected $book;
    protected $limit = 6;

    public function __construct() {
        $this->book = new Book;
    }

    public function index() {
        $keyword = $this->getRequestParam('search');
        $author = $this->getRequestParam('author');
        $category = $this->getRequestParam('category');
        $minPrice = $this->getRequestParam('minPrice');
        $maxPrice = $this->getRequestParam('maxPrice');
        $page = $this->getRequestParam('page', 1);
        $offset = ($page - 1) * $this->limit;

        if ($keyword) {
            $books = $this->book->searchBooks($keyword, $this->limit, $offset);
            $totalBooks = $this->book->getSearchBooksCount($keyword);
        } elseif ($author) {
            $books = $this->book->filterBooksByAuthor($author, $this->limit, $offset);
            $totalBooks = $this->book->getFilteredBooksCount($author, 'book_author');
        } elseif ($category) {
            $books = $this->book->filterBooksByCategory($category, $this->limit, $offset);
            $totalBooks = $this->book->getCategoryBooksCount($category);
        } elseif ($minPrice && $maxPrice) {
            $books = $this->book->filterBooksByPrice($minPrice, $maxPrice, $this->limit, $offset);
            $totalBooks = $this->book->getPriceRangeBooksCount($minPrice, $maxPrice);
        } else {
            $books = $this->book->getAllBooks($this->limit, $offset);
            $totalBooks = $this->book->getBooksCount();
        }

        $this->renderView($books, $totalBooks, $page, $keyword, $author, $category, $minPrice, $maxPrice);
    }

    public function filterByCategory($category) {
        $category = urldecode($category);
        $page = $this->getRequestParam('page', 1);
        $offset = ($page - 1) * $this->limit;

        $books = $this->book->filterBooksByCategory($category, $this->limit, $offset);
        $totalBooks = $this->book->getFilteredBooksCount($category, 'book_genre');

        $this->renderView($books, $totalBooks, $page);
    }

    private function renderView($books, $totalBooks, $page, $keyword = '', $author = '', $category = '', $minPrice = '', $maxPrice = '') {
        $totalPages = ceil($totalBooks / $this->limit);
        $categories = $this->fetchAllCategories();
        $authors = $this->book->fetchAllAuthors();
        $isLoggedIn = $this->isLoggedIn();

        $this->view('books/index', [
            'books' => $books,
            'totalPages' => $totalPages,
            'currentPage' => $page,
            'keyword' => $keyword,
            'author' => $author,
            'category' => $category,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'categories' => $categories,
            'authors' => $authors,
            'isLoggedIn' => $isLoggedIn
        ]);
    }
}
