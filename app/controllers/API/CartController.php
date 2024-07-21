<?php
namespace App\Controllers\API;

use App\Models\Cart;
use App\Models\Book;
use App\Core\API\APIController;

class CartController extends APIController {
    protected $cartModel;
    protected $book;

    public function __construct($db) {
        parent::__construct($db);
        $this->cartModel = new Cart();
        $this->book = new Book();
    }

    // POST /cart
    public function add() {
        $bookId = (int)$_POST['book_id'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        $userId = $this->isLoggedIn(); 

        if (!$userId) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $this->cartModel->addToCart($userId, $bookId, $quantity);
        $this->jsonResponse(['message' => 'Book added to cart successfully']);
    }

    // GET /cart
    public function index() {
        $userId = $this->isLoggedIn(); 

        if (!$userId) {
            $this->jsonResponse(['items' => [], 'error' => 'Unauthorized'], 401);
            return;
        }

        $items = $this->cartModel->getCartItems($userId);
        $this->jsonResponse(['items' => $items]);
    }

    // PUT /cart/{cartItemId}
    public function update($cartItemId) {
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $this->cartModel->updateQuantity($cartItemId, $quantity);
        $this->jsonResponse(['message' => 'Cart item updated successfully']);
    }

    // DELETE /cart/{cartItemId}
    public function remove($cartItemId) {
        if (!$this->isLoggedIn()) {
            $this->jsonResponse(['error' => 'Unauthorized'], 401);
            return;
        }

        $this->cartModel->removeItem($cartItemId);
        $this->jsonResponse(['message' => 'Cart item removed successfully']);
    }
}
