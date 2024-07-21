<?php
namespace App\Controllers\API;

use App\Core\API\APIController;
use App\Models\Book;

class BookDetail extends APIController {
    
    public function index() {
        // Implement if needed
    }

    public function detail($id) {
        $bookModel = new Book;
        
        // Fetch the book details
        $book = $bookModel->getBookById($id);

        // Check if the book exists
        if ($book) {
            // Book found, prepare the response
            $response = [
                'book' => $book,
                'message' => 'Book found'
            ];
            $statusCode = 200;
        } else {
            // Book not found, prepare the response for a 404 error
            $response = [
                'error' => 'Book not found'
            ];
            $statusCode = 404;
        }

        // Set headers and return JSON response
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}