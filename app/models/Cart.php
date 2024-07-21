<?php
namespace App\Models;

use App\Core\Database;

class Cart {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function addToCart($userId, $bookId, $quantity) {
        // Check if the book is already in the cart
        $stmt = $this->db->prepare("SELECT * FROM cart_items WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$userId, $bookId]);
        $existingItem = $stmt->fetch();

        if ($existingItem) {
            // Update the quantity if the book is already in the cart
            $stmt = $this->db->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE user_id = ? AND book_id = ?");
            $stmt->execute([$quantity, $userId, $bookId]);
        } else {
            // Add new item to the cart
            $stmt = $this->db->prepare("INSERT INTO cart_items (user_id, book_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $bookId, $quantity]);
        }
    }

    public function getCartItems($userId) {
        $stmt = $this->db->prepare("
            SELECT ci.cart_item_id, ci.book_id, b.book_title, b.book_image, b.book_price, ci.quantity
            FROM cart_items ci
            JOIN books b ON ci.book_id = b.book_id
            WHERE ci.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function updateQuantity($cartItemId, $quantity) {
        $stmt = $this->db->prepare("UPDATE cart_items SET quantity = ? WHERE cart_item_id = ?");
        $stmt->execute([$quantity, $cartItemId]);
    }

    public function removeItem($cartItemId) {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE cart_item_id = ?");
        $stmt->execute([$cartItemId]);
    }

    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
}