<?php
namespace App\Models;

use App\Core\Database;

class User {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function register($username, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $passwordHash]);
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }
    public function storeToken($userId, $token, $expiration) {
        $sql = "UPDATE users SET token = :token, token_expiration = :expiration WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiration', $expiration);
        $stmt->bindParam(':user_id', $userId);
        return $stmt->execute();
    }

public function validateToken($token) {
    $sql = "SELECT * FROM users WHERE token = :token AND token_expiration > NOW()";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    return $stmt->fetch();
}
public function invalidateToken($token) {
    $query = "UPDATE users SET token = NULL, token_expiration = NULL WHERE token = :token";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':token', $token);
    
    return $stmt->execute();
}
public function getAllUsers() {
    $stmt = $this->db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll();
}

public function deleteUser($userId) {
    $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);
}
}
