<!DOCTYPE html>
<html lang="en">
<head>
    <!-- head content -->
    <?php require_once APP_ROOT . '/app/views/layout/head.php'; ?>
</head>
<body>
    <!-- navigation -->
    <?php require_once APP_ROOT . '/app/views/layout/nav.php'; ?>

    <!-- Breadcrumbs Section -->
    <section class="breadcrumbs-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center padding-medium no-padding-bottom">
                    <h1>Book Details</h1>
                    <div class="breadcrumbs">
                        <span class="item">
                            <a href="<?= BASE_URL ?>">Home &gt;</a>
                        </span>
                        <span class="item">Book Details</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Section -->
    <section class="single-product padding-large">
        <div class="container">
            <div class="row">
                <!-- Product Image Gallery -->
                <div class="col-lg-6">
                    <div class="row product-preview">
                        <!-- Thumbnail Slider -->
                        <div class="swiper thumb-swiper col-3 swiper-initialized swiper-horizontal swiper-backface-hidden swiper-thumbs">
                            <div class="swiper-wrapper d-flex flex-wrap align-content-start">
                                <!-- Thumbnail Images -->
                                <div class="swiper-slide swiper-slide-active">
                                    <img src="<?= htmlspecialchars($book['book_image']) ?>" alt="<?= htmlspecialchars($book['book_title']) ?>" class="img-fluid">
                                </div>
                                <!-- Add more thumbnails if available -->
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                        <!-- Large Image Display -->
                        <div class="swiper large-swiper overflow-hidden col-9 swiper-fade">
                            <div class="swiper-wrapper">
                                <!-- Large Images -->
                                <div class="swiper-slide swiper-slide-active">
                                    <img src="<?= htmlspecialchars($book['book_image']) ?>" alt="<?= htmlspecialchars($book['book_title']) ?>" class="img-fluid">
                                </div>
                                <!-- Add more large images if available -->
                            </div>
                            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                        </div>
                    </div>
                </div>
                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info mt-3">
                        <h3 class="product-title"><?= htmlspecialchars($book['book_title']) ?></h3>
                        <div class="product-price my-3">
                            <span class="fs-1 text-primary">$<?= htmlspecialchars($book['book_price']) ?></span>
                            <?php 
                            $oldPrice = htmlspecialchars($book['book_price']) * 2; // Calculate old price
                            ?>
                            <del>$<?= number_format($oldPrice, 2) ?></del>
                        </div>
                        <p><?= htmlspecialchars($book['book_description']) ?></p>
                        <hr>
                        <?php if ($isLoggedIn): ?>
                            <div class="cart-wrap">
                                <form action="<?= BASE_URL . '/cart/add/' . $book['book_id'] ?>" method="POST">
                                    <div class="product-quantity my-3">
                                        <div class="item-title">
                                            <label for="quantity">Quantity</label>
                                        </div>
                                        <div class="stock-button-wrap d-flex flex-wrap align-items-center">
                                            <div class="product-quantity">
                                                <div class="input-group product-qty" style="max-width: 150px;">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-left-minus" data-type="minus">
                                                            <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                                        </button>
                                                    </span>
                                                    <input type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100" required>
                                                    <span class="input-group-btn">
                                                        <button type="button" class="quantity-right-plus" data-type="plus">
                                                            <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-buttons my-4 d-flex flex-wrap">
                                        <button type="submit" class="btn btn-dark me-2 mb-1">Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                        <?php else: ?>
                            <p><a href="<?= BASE_URL . '/login' ?>" class="btn btn-dark">Log in</a> to add this book to your cart.</p>
                        <?php endif; ?>
                        <hr>
                        <div class="meta-product">
                            <div class="meta-item d-flex mb-1">
                                <span class="text-uppercase me-2">SKU:</span>
                                <ul class="select-list list-unstyled d-flex mb-0">
                                    <li class="select-item"><?= htmlspecialchars($book['book_id']) ?></li>
                                </ul>
                            </div>
                            <div class="meta-item d-flex mb-1">
                                <span class="text-uppercase me-2">Genre:</span>
                                <ul class="select-list list-unstyled d-flex mb-0">
                                    <li class="select-item"><?= htmlspecialchars($book['book_genre']) ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Tabs Section -->
<section class="product-tabs">
  <div class="container">
    <div class="row">
      <div class="tabs-listing">
        <nav>
          <div class="nav nav-tabs d-flex justify-content-center py-3" id="nav-tab" role="tablist">
            <button class="nav-link fw-light text-uppercase active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
            <button class="nav-link fw-light text-uppercase" id="nav-information-tab" data-bs-toggle="tab" data-bs-target="#nav-information" type="button" role="tab" aria-controls="nav-information" aria-selected="false">Additional information</button>
            <button class="nav-link fw-light text-uppercase" id="nav-shipping-tab" data-bs-toggle="tab" data-bs-target="#nav-shipping" type="button" role="tab" aria-controls="nav-shipping" aria-selected="false">Shipping & Return</button>
            <button class="nav-link fw-light text-uppercase" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews</button>
          </div>
        </nav>
        <div class="bg-gray tab-content" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <p><?= htmlspecialchars($book['book_description']) ?></p>
          </div>
          <div class="tab-pane fade" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
          <p>this section is just for show for dynamic tab change</p>
          </div>
          <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
            <p>Returns Policy</p>
              <p>this section is just for show for dynamic tab change</p>
            <p>Shipping</p>
            <p>this section is just for show for dynamic tab change</p>
          </div>
          <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
            <div class="review-box review-style d-flex flex-wrap justify-content-between">
                  <p>this section is just for show for dynamic tab change</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

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
