<!DOCTYPE html>
<html lang="en">
<!-- head content -->
<?php require_once APP_ROOT . '/app/views/layout/head.php'; ?>
<body>
    <!-- navigation -->
    <?php require_once APP_ROOT . '/app/views/layout/nav.php'; ?>

    <!-- Breadcrumbs Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center padding-medium no-padding-bottom">
                <h1>Your Cart</h1>
                <div class="breadcrumbs">
                    <span class="item">
                        <a href="<?= BASE_URL ?>">Home &gt;</a>
                    </span>
                    <span class="item">Your Cart</span>
                </div>
            </div>
        </div>
    </div>

    <?php if (!isset($_SESSION['user_id'])): ?>
    <div class="container mt-5 text-center">
        <h3>Please log in or register to view your cart</h3>
        <a href="<?= BASE_URL . '/login' ?>" class="btn btn-dark">Log In</a>
        <a href="<?= BASE_URL . '/register' ?>" class="btn btn-dark">Register</a>
    </div>
<?php else: ?>
    <!-- Cart Section -->
    <section class="shopify-cart padding-large">
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col" class="fw-light">Product</th>
                                <th scope="col" class="fw-light">Quantity</th>
                                <th scope="col" class="fw-light">Subtotal</th>
                                <th scope="col" class="fw-light"></th>
                            </tr>
                        </thead>
                        <tbody class="border-top border-gray">
                            <?php foreach ($items as $item): ?>
                                <tr class="border-bottom border-gray">
                                    <td class="align-middle border-0" scope="row">
                                        <div class="cart-product-detail d-flex align-items-center">
                                            <div class="card-image">
                                                <img src="<?= htmlspecialchars($item['book_image']) ?>" alt="<?= htmlspecialchars($item['book_title']) ?>" class="img-fluid">
                                            </div>
                                            <div class="card-detail ps-3">
                                                <h5 class="card-title fs-4 text-uppercase">
                                                    <a href="<?= BASE_URL . '/book/detail/' . htmlspecialchars($item['book_id']) ?>"><?= htmlspecialchars($item['book_title']) ?></a>
                                                </h5>
                                                <span class="item-price text-primary fs-4">$<?= htmlspecialchars($item['book_price']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle border-0">
                                        <form action="<?= BASE_URL . '/cart/update/' . $item['cart_item_id'] ?>" method="POST">
                                            <div class="input-group product-qty" style="max-width: 150px;">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-outline-secondary" data-type="minus" data-field="">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="<?= htmlspecialchars($item['quantity']) ?>" min="1" required="">
                                                <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-outline-secondary" data-type="plus" data-field="">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <button type="submit" class="btn btn-dark mt-2">Update</button>
                                        </form>
                                    </td>
                                    <td class="align-middle border-0">
                                        <span class="item-price text-primary fs-3 fw-medium">$<?= htmlspecialchars($item['quantity'] * $item['book_price']) ?></span>
                                    </td>
                                    <td class="align-middle border-0 cart-remove">
                                        <a href="<?= BASE_URL . '/cart/remove/' . $item['cart_item_id'] ?>">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="cart-bottom d-flex flex-wrap justify-content-between align-items-center">
                        <a href="<?= BASE_URL . '/books' ?>" class="btn btn-dark">Continue Shopping</a>
                        <a href="<?= BASE_URL . '/order/place' ?>" class="btn btn-dark">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- Footer -->
    <footer class="footer">
        <?php require_once APP_ROOT . '/app/views/layout/footer.php'; ?>
    </footer>

    <script src="<?= BASE_URL . '/assets/js/jquery-1.11.0.min.js' ?>"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= BASE_URL . '/assets/js/plugins.js' ?>"></script>
    <script type="text/javascript" src="<?= BASE_URL . '/assets/js/script.js' ?>"></script>
</body>
</html>
