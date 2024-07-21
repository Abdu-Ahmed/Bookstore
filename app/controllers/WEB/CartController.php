<?php
namespace App\Controllers\WEB;

use App\Models\Cart;
use App\Models\Book;
use App\Core\Controller;

class CartController extends Controller {
    protected $cartModel;
    protected $book;

    public function __construct($db) {
        parent::__construct($db);
        $this->cartModel = new Cart();
        $this->book = new Book();
    }

    public function add($bookId) {
        if (!$this->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $userId = $this->isLoggedIn(); // Ensure to use the correct user ID

        $this->cartModel->addToCart($userId, $bookId, $quantity);
        header('Location: ' . BASE_URL . '/cart');
    }

    public function index() {
        $userId = $this->isLoggedIn(); // Ensure to use the correct user ID

        if (!$this->isLoggedIn()) {
            $this->view('cart/view', ['items' => [], 'categories' => [], 'keyword' => '', 'isLoggedIn' => false]);
            return;
        }

        $keyword = $this->getRequestParam('search');
        $items = $this->cartModel->getCartItems($userId);
        $categories = $this->fetchAllCategories();
        $isLoggedIn = $this->isLoggedIn();

        $this->view('cart/view', [
            'items' => $items,
            'categories' => $categories,
            'keyword' => $keyword,
            'isLoggedIn' => $isLoggedIn
        ]);
    }

    public function update($cartItemId) {
        if (!$this->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        $this->cartModel->updateQuantity($cartItemId, $quantity);
        header('Location: ' . BASE_URL . '/cart');
    }

    public function remove($cartItemId) {
        if (!$this->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->cartModel->removeItem($cartItemId);
        header('Location: ' . BASE_URL . '/cart');
    }
}
