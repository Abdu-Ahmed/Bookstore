<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Update Book</h1>
        <form class="bg-light" action="<?= BASE_URL . '/admin/update/' . $book['book_id'] ?>" method="POST" novalidate>
            <!-- title -->
            <div class="form-outline mb-4">
                <label for="book-title" class="form-label">Book Title:</label>
                <input type="text" name="book_title" id="title" class="form-control" placeholder="Enter title" value="<?= htmlspecialchars($book['book_title']) ?>" required>
                <?php if (isset($errors['book_title'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_title']) ?></div>
                <?php endif; ?>
            </div>
            <!-- description -->
            <div class="form-outline mb-4">
                <label for="description" class="form-label">Book Description:</label>
                <textarea name="book_description" id="description" class="form-control" placeholder="Enter description" required><?= htmlspecialchars($book['book_description']) ?></textarea>
                <?php if (isset($errors['book_description'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_description']) ?></div>
                <?php endif; ?>
            </div>
            <!-- author -->
            <div class="form-outline mb-4">
                <label for="author" class="form-label">Book Author:</label>
                <input type="text" name="book_author" id="author" class="form-control" placeholder="Enter author name" value="<?= htmlspecialchars($book['book_author']) ?>" required>
                <?php if (isset($errors['book_author'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_author']) ?></div>
                <?php endif; ?>
            </div>
            <!-- price -->
            <div class="form-outline mb-4">
                <label for="price" class="form-label">Book Price:</label>
                <input type="number" name="book_price" id="price" class="form-control" placeholder="Enter price" value="<?= htmlspecialchars($book['book_price']) ?>" min="0" required>
                <?php if (isset($errors['book_price'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_price']) ?></div>
                <?php endif; ?>
            </div>
            <!-- genre -->
            <div class="form-outline mb-4">
                <label for="book_genre" class="form-label">Select Genre:</label>
                <input type="text" name="book_genre" id="book_genre" class="form-control" placeholder="Enter genre name" value="<?= htmlspecialchars($book['book_genre']) ?>" required>
                <?php if (isset($errors['book_genre'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_genre']) ?></div>
                <?php endif; ?>
            </div>
            <!-- book cover img -->
            <div class="form-outline mb-4">
                <label for="img-url" class="form-label">Update Book Cover:</label>
                <input type="url" name="book_image" class="form-control" id="img-url" placeholder="img url ex: https://example.com" value="<?= htmlspecialchars($book['book_image']) ?>" pattern="https://.*" required />
                <?php if (isset($errors['book_image'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['book_image']) ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <a href="<?= BASE_URL . '/admin' ?>" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" name="submit" class="btn btn-primary">Update Book</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
