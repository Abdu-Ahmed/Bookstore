<?php

namespace App\Core;
use App\Models\Book;
use App\Core\Database;
class Controller
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

    protected function view($view, $data = []) 
    {
        $viewFile = __DIR__ . "/../views/{$view}.php";
        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            throw new \Exception("View file '$viewFile' not found.");
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

    public function redirectWithError($url, $message) {
        $_SESSION['error_message'] = $message;
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    public function getRequestParam($param, $default = null) {
        return isset($_GET[$param]) ? filter_var($_GET[$param], FILTER_SANITIZE_STRING) : $default;
    }
    protected function abort($code = 404) {
        http_response_code($code);
        require_once "../app/views/{$code}.php";
        die();
    }
}
