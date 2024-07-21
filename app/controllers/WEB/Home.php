<?php

namespace App\Controllers\WEB;

use App\Models\Book;
use App\Core\Controller;

class Home extends Controller {
    protected $book;

    public function __construct($db) {
        parent::__construct($db);
        $this->book = new Book;
    }

    public function index() {
        $keyword = $this->getRequestParam('search');
        
        if ($keyword) {
            $books = $this->book->searchBooks($keyword);
        } else {
            $books = $this->book->getAllBooks();
        }

        $categories = $this->fetchAllCategories();
        $randomBooks = $this->book->getRandomBooks(5);
        $isLoggedIn = $this->isLoggedIn();

        $this->view('home', [
            'books' => $books,
            'keyword' => $keyword,
            'categories' => $categories,
            'randomBooks' => $randomBooks,
            'isLoggedIn' => $isLoggedIn
        ]);
    }
}
