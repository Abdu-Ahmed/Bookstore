<?php

namespace App\Core\API;

use App\Models\Book;
use App\Core\Database;

class APIController
{
    protected $book;
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->book = new Book();
    }

    protected function model($model) 
    {
        $modelClass = 'App\\Models\\' . $model;
        if (class_exists($modelClass)) {
            return new $modelClass($this->db);
        } else {
            throw new \Exception("Model '$modelClass' not found.");
        }
    }


    protected function handlePostRequest($modelMethod, $requestData) 
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $model = $this->model('model');
            if (method_exists($model, $modelMethod)) {
                call_user_func_array([$model, $modelMethod], $requestData);
            } else {
                throw new \Exception("Method '$modelMethod' not found in Model class.");
            }
        }
    }
    
    public function fetchAllCategories() {
        return $this->book->fetchAllCategories();
    }

    protected function isLoggedIn() {
        return $_SESSION['user_id'] ?? null;
    }

     // Utility method for returning JSON responses
     public function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

    // Utility method for getting request data (for POST/PUT methods)
    public function getRequestData() {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function getRequestParam($param, $default = null) {
        return isset($_GET[$param]) ? filter_var($_GET[$param], FILTER_SANITIZE_STRING) : $default;
    }
}
