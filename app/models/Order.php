<?php
namespace App\Models;

use App\Core\Database;

class Order {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db->getConnection();
    }

    public function createOrder($userId, $totalPrice) {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
        $stmt->execute([$userId, $totalPrice]);
        return $this->db->lastInsertId(); // Return the newly created order ID
    }

    public function addOrderItem($orderId, $bookId, $quantity, $price) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $bookId, $quantity, $price]);
    }

    public function getOrderById($orderId) {
        $stmt = $this->db->prepare("
            SELECT o.order_id, o.order_date, o.total_price, b.book_title, oi.quantity, oi.price
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN books b ON oi.book_id = b.book_id
            WHERE o.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }
    public function getOrdersByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT order_id, total_price AS total_amount, order_date AS created_at, status
            FROM orders
            WHERE user_id = ?
            ORDER BY order_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function updateOrderStatus($orderId, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$status, $orderId]);
    }
    public function getAllOrders() {
        $stmt = $this->db->prepare("
            SELECT o.order_id, o.order_date, o.total_price, u.username, o.status
            FROM orders o
            JOIN users u ON o.user_id = u.user_id
            ORDER BY o.order_date DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
