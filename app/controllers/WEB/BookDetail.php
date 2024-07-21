<?php
namespace App\Controllers\WEB;

use App\Core\Controller;
use App\Models\Book;

class BookDetail extends Controller {
    
    public function index() {
        // Implement if needed
    }

    public function detail($id) {
        $bookModel = new Book;
        $categories = $this->fetchAllCategories();
        $keyword = $this->getRequestParam('search', '');
        $isLoggedIn = $this->isLoggedIn();

        $book = $bookModel->getBookById($id);

        if ($book) {
            $this->view('books/detail', [
                'book' => $book,
                'categories' => $categories,
                'keyword' => $keyword,
                'isLoggedIn' => $isLoggedIn]);
        } else {
            $this->view('404');
        }
    }
}
