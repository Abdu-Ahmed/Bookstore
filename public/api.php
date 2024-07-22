<?php
session_start();
define('BASE_URL', 'http://localhost/bookstore/public');

define('APP_ROOT', dirname(__DIR__));

require_once 'autoload.php';

use App\Core\API\APIRouter;
use App\Core\API\APIApp;
use App\Core\Database;

$routes = require('../app/routes/api.php');

// Initialize the database connection
$db = new Database();

// Initialize the router with API routes
$router = new APIRouter($routes);

// Create the application instance and run
$app = new APIApp($router, $db);
$app->run();
