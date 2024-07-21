<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <title>Manage Orders</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Manage Orders</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_id']) ?></td>
                            <td><?= htmlspecialchars($order['username']) ?></td>
                            <td><?= htmlspecialchars($order['total_price']) ?></td>
                            <td><?= htmlspecialchars($order['order_date']) ?></td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <td>
                            <a href="<?= BASE_URL . '/admin/manageOrders/view/' . htmlspecialchars($order['order_id']) ?>" class="btn btn-sm btn-info">View</a>
                            <a href="<?= BASE_URL . '/admin/manageOrders/updateStatus/' . htmlspecialchars($order['order_id']) ?>" class="btn btn-sm btn-warning">Update Status</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
