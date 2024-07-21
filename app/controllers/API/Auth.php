<?php
namespace App\Controllers\API;

use App\Core\API\APIController;
use App\Core\Validator;
use App\Models\User;

class Auth extends APIController {
    protected $userModel;
    protected $validator;

    public function __construct($db) {
        parent::__construct($db);
        $this->userModel = new User();
        $this->validator = new Validator();
    }

    // POST /auth/register
    public function register() {
        // Read the raw POST data
        $json = file_get_contents('php://input');
        
        // Decode JSON data to PHP associative array
        $data = json_decode($json, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->jsonResponse(['errors' => ['json' => 'Invalid JSON format.']], 400);
            return;
        }
    
        // Extract and sanitize values from the decoded data
        $username = $this->validator->sanitizeInput($data['username'] ?? '');
        $email = $this->validator->sanitizeInput($data['email'] ?? '');
        $password = $this->validator->sanitizeInput($data['password'] ?? '');
        $confirmPassword = $this->validator->sanitizeInput($data['confirm_password'] ?? '');
    
        // Validate input
        $this->validator->required('username', $username)
                        ->required('email', $email)
                        ->email('email', $email)
                        ->required('password', $password)
                        ->required('confirm_password', $confirmPassword);
    
        if ($this->validator->fails()) {
            $this->jsonResponse(['errors' => $this->validator->errors()], 400);
            return;
        }
    
        if ($password === $confirmPassword) {
            $this->userModel->register($username, $email, $password);
            $this->jsonResponse(['message' => 'User registered successfully'], 201);
        } else {
            $this->jsonResponse(['errors' => ['confirm_password' => 'Passwords do not match.']], 400);
        }
    }

    // POST /auth/login
    public function login() {
        // Read the raw POST data
        $json = file_get_contents('php://input');
        
        // Decode JSON data to PHP associative array
        $data = json_decode($json, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->jsonResponse(['errors' => ['json' => 'Invalid JSON format.']], 400);
            return;
        }
    
        // Extract and sanitize values from the decoded data
        $username = $this->validator->sanitizeInput($data['username'] ?? '');
        $password = $this->validator->sanitizeInput($data['password'] ?? '');
    
        // Validate input
        $this->validator->required('username', $username)
                        ->required('password', $password);
    
        if ($this->validator->fails()) {
            $this->jsonResponse(['errors' => $this->validator->errors()], 400);
            return;
        }
    
        // Attempt to log in the user
        $user = $this->userModel->login($username, $password);
    
        if ($user) {
            // Generate and store a new token
            $token = bin2hex(random_bytes(16)); // Generate a random token
            $expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Set token expiration (e.g., 1 hour from now)
            $this->userModel->storeToken($user['user_id'], $token, $expiration);
    
            // Respond with the token
            $this->jsonResponse([
                'message' => 'Login successful',
                'token' => $token
            ]);
        } else {
            $this->jsonResponse(['errors' => ['login' => 'Invalid username or password.']], 401);
        }
    }

    // POST /auth/logout
    public function logout() {
        // Read the token from the request header or body
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;

        if ($token) {
            // Invalidate the token
            $this->userModel->invalidateToken($token);
            $this->jsonResponse(['message' => 'Logged out successfully']);
        } else {
            $this->jsonResponse(['errors' => ['token' => 'No token provided.']], 400);
        }
    }
}
