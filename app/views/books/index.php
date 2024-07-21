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
                <!-- Conditional H1 Text -->
                <h1><?= !empty($keyword) ? 'Search Results' : 'Shop' ?></h1>
                <div class="breadcrumbs">
                    <span class="item">
                        <a href="<?= BASE_URL ?>">Home &gt;</a>
                    </span>
                    <span class="item"><?= !empty($keyword) ? 'Search Results' : 'Shop' ?></span>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="container p-5">
        <div class="row">
            <!-- Filter Sidebar -->
            <aside class="col-md-3">
                <div class="sidebar">
                    <div class="widget-menu">
                        <div class="widget-search-bar glow-red">
                            <form method="GET" action="<?= BASE_URL . '/books' ?>" class="position-relative d-flex justify-content-between align-items-center border-bottom border-dark py-1">
                                <input class="search-field link-danger" name="search" placeholder="Search" type="search" value="<?= htmlspecialchars($keyword) ?>">
                                <div class="search-icon position-absolute end-0">
                                    <button type="submit" class="btn btn-link">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <form method="GET" action="<?= BASE_URL . '/books' ?>">
                        <div class="widget-product-categories pt-5">
                            <h5 class="widget-title text-uppercase">Categories</h5>
                            <ul class="product-categories sidebar-list list-unstyled">
                                <li class="cat-item link-danger">
                                    <select name="category" id="category" class="form-select glow-red">
                                        <option class="glow-red" value="">All Categories</option>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= htmlspecialchars($cat['book_genre']) ?>" <?= ($cat['book_genre'] == $category) ? 'selected' : '' ?>><?= htmlspecialchars($cat['book_genre']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-product-tags pt-3">
                            <h5 class="widget-title text-uppercase">Authors</h5>
                            <ul class="product-tags sidebar-list list-unstyled">
                                <li class="tags-item">
                                    <select name="author" id="author" class="form-select glow-red">
                                        <option value="">All Authors</option>
                                        <?php foreach ($authors as $auth): ?>
                                            <option value="<?= htmlspecialchars($auth['book_author']) ?>" <?= ($auth['book_author'] == $author) ? 'selected' : '' ?>><?= htmlspecialchars($auth['book_author']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-price-filter pt-3">
                            <h5 class="widget-title text-uppercase">Price Range</h5>
                            <ul class="product-tags sidebar-list list-unstyled">
                                <li class="tags-item">
                                    <label for="minPrice" class="form-label">Min Price</label>
                                    <input type="number" name="minPrice" id="minPrice" class="form-control link-danger glow-red" value="<?= htmlspecialchars($minPrice) ?>">
                                </li>
                                <li class="tags-item">
                                    <label for="maxPrice" class="form-label">Max Price</label>
                                    <input type="number" name="maxPrice" id="maxPrice" class="form-control link-danger glow-red" value="<?= htmlspecialchars($maxPrice) ?>">
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-dark me-2 mb-1">Filter</button>
                        <a class="btn btn-dark me-2 mb-1" href="<?= BASE_URL . '/books' ?>">Reset</a>
                    </form>
                </div>
            </aside>

            <!-- Books Section -->
            <div class="col-md-9">
                <div class="row">
                    <?php if (!empty($books)): ?>
                        <?php foreach ($books as $book): ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="product-card mb-4">
                                    <div class="image-holder">
                                        <img src="<?= htmlspecialchars($book['book_image']) ?>" alt="<?= htmlspecialchars($book['book_title']) ?>" class="img-fluid">
                                    </div>
                                    <div class="card-detail text-center pt-3 pb-2">
                                        <h5 class="card-title fs-4 text-uppercase m-0">
                                            <a href="<?= BASE_URL . '/book-detail/' . $book['book_id'] ?>"><?= htmlspecialchars($book['book_title']) ?></a>
                                        </h5>
                                        <span class="item-price text-primary fs-4">$<?= htmlspecialchars($book['book_price']) ?></span>
                                        <div class="cart-button mt-1">
                                            <?php if ($isLoggedIn): ?>
                                                <form action="<?= BASE_URL . '/cart/add/' . $book['book_id'] ?>" method="POST" class="d-inline">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn">Add to cart</button>
                                                </form>
                                            <?php else: ?>
                                                <p><a href="<?= BASE_URL . '/login' ?>" class="btn btn-dark">Log in</a> to add this book to your cart.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books available.</p>
                    <?php endif; ?>
                </div>
                <!-- Pagination -->
                <div class="pagination loop-pagination d-flex justify-content-center align-items-center">
                    <?php if ($currentPage > 1): ?>
                        <a href="<?= BASE_URL . '/books?page=' . ($currentPage - 1) ?>" class="d-flex pe-2">
                            <svg width="24" height="24"><use xlink:href="#angle-left"></use></svg>
                        </a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i == $currentPage): ?>
                            <span aria-current="page" class="page-numbers current pe-3"><?= $i ?></span>
                        <?php else: ?>
                            <a class="page-numbers pe-3" href="<?= BASE_URL . '/books?page=' . $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?= BASE_URL . '/books?page=' . ($currentPage + 1) ?>" class="d-flex ps-2">
                            <svg width="24" height="24"><use xlink:href="#angle-right"></use></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require_once APP_ROOT . '/app/views/layout/footer.php'; ?>
</body>
</html>
