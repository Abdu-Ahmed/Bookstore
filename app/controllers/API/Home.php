<?php
namespace App\Controllers\API;

use App\Models\Book;
use App\Core\API\APIController;

class HomeController extends APIController {
    protected $book;

    public function __construct($db) {
        parent::__construct($db);
        $this->book = new Book();
    }

    // GET /home
    public function index() {
        $keyword = $this->getRequestParam('search');
        
        if ($keyword) {
            $books = $this->book->searchBooks($keyword);
        } else {
            $books = $this->book->getAllBooks();
        }
        
        $this->jsonResponse(['books' => $books]);
    }
}
