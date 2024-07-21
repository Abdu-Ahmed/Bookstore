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
    <title>View Order</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Order Details</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($order)): ?>
                    <?php foreach ($order as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['book_title']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= htmlspecialchars($item['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No order details found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <form action="<?= BASE_URL . '/admin/manageOrders/updateStatus/' . htmlspecialchars($order['order_id']) ?>" method="POST">
            <div class="mb-3">
                <label for="status" class="form-label">Update Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Shipped" <?= $order['status'] === 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="Delivered" <?= $order['status'] === 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                    <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
</body>
</html>
