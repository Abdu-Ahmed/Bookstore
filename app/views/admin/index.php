<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
</head>
<body>
<div class="container">
        <h1 class="my-4">Admin Dashboard</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="<?= BASE_URL . '/admin/create' ?>" class="btn btn-primary">Add New Book</a>
            <a href="<?= BASE_URL . '/admin/manageUsers' ?>" class="btn btn-secondary">Manage Users</a>
            <a href="<?= BASE_URL . '/admin/manageOrders' ?>" class="btn btn-info">Manage Orders</a>
            <form action="<?= BASE_URL . '/admin' ?>" method="GET" class="input-group w-50">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="<?= htmlspecialchars($keyword) ?>">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['book_genre']) ?>" <?= isset($category) && $category === $cat['book_genre'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['book_genre']) ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="sort" class="form-select">
                    <option value="book_title" <?= $sort === 'book_title' ? 'selected' : '' ?>>Title</option>
                    <option value="book_author" <?= $sort === 'book_author' ? 'selected' : '' ?>>Author</option>
                    <option value="book_price" <?= $sort === 'book_price' ? 'selected' : '' ?>>Price</option>
                </select>
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['book_id']) ?></td>
                            <td><?= htmlspecialchars($book['book_title']) ?></td>
                            <td><?= htmlspecialchars($book['book_author']) ?></td>
                            <td><?= htmlspecialchars($book['book_price']) ?></td>
                            <td>
                                <a href="<?= BASE_URL . '/admin/update/' . htmlspecialchars($book['book_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= BASE_URL . '/admin/delete/' . htmlspecialchars($book['book_id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($totalBooks > $limit): ?>
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= ceil($totalBooks / $limit); $i++): ?>
                        <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                            <a class="page-link" href="<?= BASE_URL . '/admin?page=' . $i . '&search=' . htmlspecialchars($keyword) . '&category=' . htmlspecialchars($category) . '&sort=' . htmlspecialchars($sort) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</body>
</html>
