<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Book</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert New Book</h1>
        <!-- Display error message if available -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form class="bg-light" action="<?= BASE_URL . '/admin/create' ?>" method="POST" enctype="multipart/form-data">
            <!-- Title -->
            <div class="form-outline mb-4">
                <label for="book-title" class="form-label">Book Title:</label>
                <input type="text" name="book-title" id="title" class="form-control" placeholder="Enter title" autocomplete="off" required>
            </div>
            <!-- Description -->
            <div class="form-outline mb-4">
                <label for="book-description" class="form-label">Book Description:</label>
                <textarea name="book-description" id="description" class="form-control" placeholder="Enter description" autocomplete="off" required></textarea>
            </div>
            <!-- Author -->
            <div class="form-outline mb-4">
                <label for="book-author" class="form-label">Book Author:</label>
                <input type="text" name="book-author" id="author" class="form-control" placeholder="Enter author name" autocomplete="off" required>
            </div>
            <!-- Price -->
            <div class="form-outline mb-4">
                <label for="book-price" class="form-label">Book Price:</label>
                <input type="number" name="book-price" id="price" class="form-control" placeholder="Enter price" autocomplete="off" required>
            </div>
            <!-- Genre -->
            <div class="form-outline mb-4">
                <label for="book_genre" class="form-label">Select Genre:</label>
                <input type="text" name="book_genre" id="book_genre" class="form-control" placeholder="Enter genre name" autocomplete="off" required>
            </div>
            <!-- Book Cover Image -->
            <div class="form-outline mb-4">
                <label for="book-cover" class="form-label">Insert Book Cover:</label>
                <input type="url" name="book-img" class="form-control" id="img-url" placeholder="img url ex: https://example.com" pattern="https://.*" size="30" required />
            </div>
            <div class="mb-3">
                <a href="<?= BASE_URL . '/admin' ?>" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" name="submit" class="btn btn-primary">Save new Book</button>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
