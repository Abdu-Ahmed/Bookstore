<?php

namespace App\Controllers\WEB;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Core\Controller;

class OrderController extends Controller {
    protected $book;
    protected $cartModel;
    protected $orderModel;

    public function __construct($db) {
        parent::__construct($db);
        $this->cartModel = new Cart;
        $this->book = new Book;
        $this->orderModel = new Order($db);

    }

    public function index() {
        // Implement index method or leave it if not needed for this controller
    }

    public function placeOrder() {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to place an order.');
            return;
        }

        $userId = $this->isLoggedIn();
       $keyword = $this->getRequestParam('search');

        $items = $this->cartModel->getCartItems($userId);

        if (empty($items)) {
            $this->redirectWithError('/cart', 'Your cart is empty.');
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

        header('Location: ' . BASE_URL . '/order/confirmation/' . $orderId);
        exit;
    }

    public function orderConfirmation($orderId) {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view your order confirmation.');
            return;
        }

       $keyword = $this->getRequestParam('search');
       $orderDetails = $this->orderModel->getOrderById($orderId);
       $isLoggedIn = $this->isLoggedIn();

        if (empty($orderDetails)) {
            $this->view('404');
            return;
        }

        $this->view('order/confirmation', ['orderDetails' => $orderDetails,
         'keyword' => $keyword,
        'isLoggedIn' => $isLoggedIn]);
    }

    public function orderHistory() {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view your order history.');
            return;
        }

        $userId =$this->isLoggedIn();
       $keyword = $this->getRequestParam('search');

        $orders = $this->orderModel->getOrdersByUserId($userId);
        $categories = $this->fetchAllCategories();
        $isLoggedIn = $this->isLoggedIn();

        $this->view('order/history', ['orders' => $orders,
         'keyword' => $keyword,
         'categories' => $categories,
         'isLoggedIn' => $isLoggedIn]);
    }

    public function orderDetails($orderId) {
        if (!$this->isLoggedIn()) {
            $this->redirectWithError('/login', 'You need to log in to view order details.');
            return;
        }

        $keyword = $this->getRequestParam('search');
        $orderDetails = $this->orderModel->getOrderById($orderId);
        $categories = $this->fetchAllCategories();
        $isLoggedIn = $this->isLoggedIn();

        if (empty($orderDetails)) {
            $this->view('404');
            return;
        }

        $this->view('order/details', ['orderDetails' => $orderDetails,
         'keyword' => $keyword,
         'categories' => $categories,
         'isLoggedIn' => $isLoggedIn]);
    }
}
