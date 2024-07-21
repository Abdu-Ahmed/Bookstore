<!DOCTYPE html>
<html lang="en">
<!-- head content -->
<?php require_once APP_ROOT . '/app/views/layout/head.php'; ?>
<body>
    <!-- navigation -->
    <?php require_once APP_ROOT . '/app/views/layout/nav.php'; ?>

    <div class="container">
        <h1>Order History</h1>

        <?php if (!$isLoggedIn): ?>
            <div class="container mt-5 text-center">
                <h3>Please log in or register to view your orders</h3>
                <a href="<?= BASE_URL . '/login' ?>" class="btn btn-dark">Log In</a>
                <a href="<?= BASE_URL . '/register' ?>" class="btn btn-dark">Register</a>
            </div>
        <?php else: ?>
            <?php if (empty($orders)): ?>
                <p>No orders found.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['order_id'] ?></td>
                                <td>$<?= htmlspecialchars($order['total_amount']) ?></td>
                                <td><?= htmlspecialchars($order['status']) ?></td>
                                <td><?= htmlspecialchars($order['created_at']) ?></td>
                                <td>
                                    <a href="<?= BASE_URL . '/order/' . htmlspecialchars($order['order_id']) ?>" class="btn btn-dark">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
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
