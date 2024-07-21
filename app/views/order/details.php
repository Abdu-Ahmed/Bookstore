<!DOCTYPE html>
<html lang="en">
<!-- head content -->
<?php require_once APP_ROOT . '/app/views/layout/head.php'; ?>
<body>
    <!-- navigation -->
    <?php require_once APP_ROOT . '/app/views/layout/nav.php'; ?>

    <div class="container">
        <h1>Order Details</h1>

        <?php if (!$isLoggedIn): ?>
            <div class="container mt-5 text-center">
                <h3>Please log in or register to view your orders</h3>
                <a href="<?= BASE_URL . '/login' ?>" class="btn btn-dark">Log In</a>
                <a href="<?= BASE_URL . '/register' ?>" class="btn btn-dark">Register</a>
            </div>
        <?php else: ?>
            <?php if (empty($orderDetails)): ?>
                <p>No details found for this order.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderDetails as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['book_title']) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td>$<?= htmlspecialchars($item['price']) ?></td>
                                <td>$<?= htmlspecialchars($item['quantity'] * $item['price']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                            <td>$<?= htmlspecialchars(array_sum(array_map(function($item) {
                                return $item['price'] * $item['quantity'];
                            }, $orderDetails))) ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>

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
