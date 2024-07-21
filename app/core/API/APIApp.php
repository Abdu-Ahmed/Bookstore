<?php

namespace App\Core\API;
use App\Core\Database;

class APIApp {
    protected $router;
    protected $db;

    public function __construct(APIRouter $router, Database $db) {
        $this->router = $router;
        $this->db = $db;
    }

    public function run() {
        // Parse the current URI
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Route to the appropriate controller
        $route = $this->router->dispatch($method, $uri);

        if ($route !== false) {
            // Extract controller, method, and parameters
            $controllerName = $route['controller'];
            $method = $route['method'];
            $params = array_values($route['params']); // Convert associative array to indexed array

            // Create an instance of the controller class and pass the db instance
            $controller = new $controllerName($this->db);

            // Call the method with parameters
            call_user_func_array([$controller, $method], $params);
        } else {
            $this->abort();
        }
    }

    protected function abort($code = 404) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Resource not found']);
        die();
    }
}