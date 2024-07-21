<?php

namespace App\Controllers\API;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Core\API\APIController;

class OrderController extends APIController {
    protected $book;
    protected $cartModel;
    protected $orderModel;

    public function __construct($db) {
        parent::__construct($db);
        $this->cartModel = new Cart();
        $this->book = new Book();
        $this->orderModel = new Order($db);
    }

    // GET /orders
    public function index() {
        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $userId = $this->isLoggedIn();
        $orders = $this->orderModel->getOrdersByUserId($userId);
        $this->jsonResponse(['orders' => $orders]);
    }

    // POST /orders
    public function placeOrder() {
        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $userId = $this->isLoggedIn();
        $items = $this->cartModel->getCartItems($userId);

        if (empty($items)) {
            $this->jsonResponse(['error' => 'Your cart is empty.'], 400);
            return;
        }

        $totalPrice = array_sum(array_map(function($item) {
            return $item['book_price'] * $item['quantity'];
        }, $items));

        $orderId = $this->orderModel->createOrder($userId, $totalPrice);

        foreach ($items as $item) {
            $this->orderModel->addOrderItem($orderId, $item['book_id'], $item['quantity'], $item['book_price']);
        }

        $this->cartModel->clearCart($userId);

        $this->jsonResponse(['message' => 'Order placed successfully', 'orderId' => $orderId]);
    }

    // GET /orders/{orderId}
    public function show($orderId) {
        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $orderDetails = $this->orderModel->getOrderById($orderId);

        if (empty($orderDetails)) {
            $this->jsonResponse(['error' => 'Order not found.'], 404);
            return;
        }

        $this->jsonResponse(['orderDetails' => $orderDetails]);
    }

    // GET /orders/history
    public function history() {
        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $userId = $this->isLoggedIn();
        $orders = $this->orderModel->getOrdersByUserId($userId);
        $this->jsonResponse(['orders' => $orders]);
    }
}
