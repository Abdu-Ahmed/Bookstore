<?php
namespace App\Controllers\API;

use App\Core\API\APIController;
use App\Models\Book;

class Books extends APIController {
    protected $book;
    protected $limit = 6;

    public function __construct() {
        $this->book = new Book;
    }

    // GET /api/books
    public function index() {
        $page = $this->getRequestParam('page', 1);
        $offset = ($page - 1) * $this->limit;

        $books = $this->book->getAllBooks($this->limit, $offset);
        $totalBooks = $this->book->getBooksCount();

        return $this->jsonResponse([
            'books' => $books,
            'totalBooks' => $totalBooks,
            'currentPage' => $page,
            'totalPages' => ceil($totalBooks / $this->limit)
        ]);
    }
    public function filterByCategory($category)
{
    $category = urldecode($category);
    $page = $this->getRequestParam('page', 1);
    $offset = ($page - 1) * $this->limit;

    $books = $this->book->filterBooksByCategory($category, $this->limit, $offset);
    $totalBooks = $this->book->getFilteredBooksCount($category, 'book_genre');

    // Prepare the response data
    $response = [
        'books' => $books,
        'totalBooks' => $totalBooks,
        'currentPage' => $page,
        'totalPages' => ceil($totalBooks / $this->limit)
    ];

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

    // GET /api/books/{id}
    public function show($id) {
        $book = $this->book->getBookById($id);

        if ($book) {
            return $this->jsonResponse($book);
        } else {
            return $this->jsonResponse(['error' => 'Book not found'], 404);
        }
    }

    // POST /api/books
    public function store() {
        $data = $this->getRequestData();
        $result = $this->book->createBook($data);

        if ($result) {
            return $this->jsonResponse(['message' => 'Book created successfully'], 201);
        } else {
            return $this->jsonResponse(['error' => 'Failed to create book'], 500);
        }
    }

    // PUT /api/books/{id}
    public function update($id) {
        $data = $this->getRequestData();
        $result = $this->book->updateBook($id, $data);

        if ($result) {
            return $this->jsonResponse(['message' => 'Book updated successfully']);
        } else {
            return $this->jsonResponse(['error' => 'Failed to update book'], 500);
        }
    }

    // DELETE /api/books/{id}
    public function delete($id) {
        $result = $this->book->deleteBook($id);

        if ($result) {
            return $this->jsonResponse(['message' => 'Book deleted successfully']);
        } else {
            return $this->jsonResponse(['error' => 'Failed to delete book'], 500);
        }
    }
}
