<?php
namespace App\Controllers\WEB;

use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;
use App\Models\Book;

class Auth extends Controller {
    protected $book;
    protected $userModel;
    protected $validator;

    public function __construct() {
        $this->userModel = new User();
        $this->validator = new Validator();
        $this->book = new Book();
    }

    public function index() {
        // Implement if needed
    }

    public function register() {
        $errors = [];
        $categories = $this->fetchAllCategories();
        $keyword = $this->getRequestParam('search', '');
        $isLoggedIn = $this->isLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->validator->sanitizeInput($_POST['username']);
            $email = $this->validator->sanitizeInput($_POST['email']);
            $password = $this->validator->sanitizeInput($_POST['password']);
            $confirmPassword = $this->validator->sanitizeInput($_POST['confirm_password']);

            // Validate the inputs
            $this->validator->required('username', $username)
                            ->required('email', $email)
                            ->email('email', $email)
                            ->required('password', $password)
                            ->required('confirm_password', $confirmPassword);

            if ($this->validator->fails()) {
                $errors = $this->validator->errors();
                $this->view('user/account', ['errors' => $errors,
                 'categories' => $categories,
                 'keyword' => $keyword,
                 'isLoggedIn' => $isLoggedIn]);
                return;
            }

            // Check if passwords match
            if ($password === $confirmPassword) {
                // Register the user
                $this->model('User')->register($username, $email, $password);
                header('Location: ' . BASE_URL . '/login');
                exit();
            } else {
                $errors['confirm_password'] = 'Passwords do not match.';
                $this->view('user/account', ['errors' => $errors,
                'categories' => $categories,
                'keyword' => $keyword,
                'isLoggedIn' => $isLoggedIn]);
            }
        } else {
            $this->view('user/account',  ['errors' => $errors,
            'categories' => $categories,
            'keyword' => $keyword,
            'isLoggedIn' => $isLoggedIn]);
        }
    }

    public function login() {
        $errors = [];
        $categories = $this->fetchAllCategories();
        $keyword = $this->getRequestParam('search', '');
        $isLoggedIn = $this->isLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->validator->sanitizeInput($_POST['username']);
            $password = $this->validator->sanitizeInput($_POST['password']);

            // Validate the inputs
            $this->validator->required('username', $username)
                            ->required('password', $password);

            if ($this->validator->fails()) {
                $errors = $this->validator->errors();
                $this->view('user/account', 
                ['errors' => $errors,
                 'categories' => $categories,
                 'keyword' => $keyword,
                 'isLoggedIn' => $isLoggedIn]);
                return;
            }

            // Attempt login
            $user = $this->model('User')->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ' . BASE_URL);
                exit();
            } else {
                $errors['login'] = 'Invalid username or password.';
                $this->view('user/account', ['errors' => $errors,
                 'categories' => $categories,
                 'keyword' => $keyword,
                 'isLoggedIn' => $isLoggedIn]);
            }
        } else {
            $this->view('user/account',  ['errors' => $errors,
            'categories' => $categories,
            'keyword' => $keyword,
            'isLoggedIn' => $isLoggedIn]);
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL);
        exit();
    }
}
