<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'layout/head.php'; ?>
</head>
<body>
 
    <!-- navigation -->
    <?php require_once 'layout/nav.php'; ?>
    <!-- Greeting Section -->
    <div class="container mt-5">
    <h2 class="display-5">Welcome to Abdu's Bookstore!</h2>
    <?php if ($isLoggedIn): ?>
        <p class="display-6">Hello, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>! Welcome back. Explore our collection of books and add them to your cart.</p>
        <div class="d-flex gap-3">
            <a href="<?= BASE_URL . '/cart' ?>" class="btn btn-dark rounded-pill">View Cart</a>
            <a href="<?= BASE_URL . '/admin' ?>" class="btn btn-dark rounded-pill">Admin Panel</a>
        </div>
    <?php else: ?>
        <p class="display-6">Please <a href="<?= BASE_URL . '/login' ?>" class="btn-lg btn btn-dark">log in</a> or <a href="<?= BASE_URL . '/register' ?>" class="btn-lg btn btn-dark">register</a> to start shopping.</p>
    <?php endif; ?>
</div>
<br>
    <!-- Landing billboard Section -->
     <h1 class="d-flex justify-content-center mt-5">Recommended reads</h1>
    <section id="billboard" class="bg-gray padding-large">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">
            <?php foreach ($randomBooks as $book): ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="offset-md-1 col-md-5">
                                <img src="<?php echo $book['book_image']; ?>" alt="product-img" class="img-fluid mb-3">
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="banner-content">
                                    <h2><?php echo $book['book_title']; ?></h2>
                                    <p class="fs-3"><?php echo $book['book_description']; ?></p>
                                    <a href="<?= BASE_URL . '/book-detail/' . $book['book_id'] ?>" class="btn">Shop now →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="main-slider-pagination text-center mt-3"></div>
</section>
 <!-- Website info Section -->
<section id="company-services" class="padding-xlarge">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box text-center">
              <span class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                <svg width="30" height="30" class="cart-outline text-primary">
                  <use xlink:href="#cart-outline">
                </svg>
              </span>
              <div class="icon-box-content">
                <h4 class="card-title">Free delivery</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box text-center">
              <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                <svg width="30" height="30" class="quality text-primary">
                  <use xlink:href="#quality">
                </svg>
              </div>
              <div class="icon-box-content">
                <h4 class="card-title">Quality guarantee</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box text-center">
              <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                <svg width="30" height="30" class="price-tag text-primary">
                  <use xlink:href="#price-tag">
                </svg>
              </div>
              <div class="icon-box-content">
                <h4 class="card-title">Daily offers</h4>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 pb-3">
            <div class="icon-box text-center">
              <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                <svg width="30" height="30" class="shield-plus text-primary">
                  <use xlink:href="#shield-plus">
                </svg>
              </div>
              <div class="icon-box-content">
                <h4 class="card-title">100% secure payment</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> 
    <!-- site quote -->
    <section id="about">
      <div class="container">
        <div class="row position-relative">
          <div class="col-lg-8">
            <div class="image-holder">
              
              <img src="<?= BASE_URL . '/assets/images/single-image3.jpg' ?>" alt="single" class="single-image img-fluid">
            </div>
          </div>
          <div class="about-content bg-gray col-lg-4 m-auto top-0 end-0 bottom-0">
          <h3 class="py-3 display-3">Abdu's Bookstore</h3>
          <p class="display-6 lead">A book a day keeps the mind at bay!</p>
          </div>
        </div>
      </div>
    </section>
    <!-- Books Carousel Section -->
    <section id="products" class="product-store position-relative padding-xlarge pb-0">
  <div class="container display-header d-flex flex-wrap justify-content-between pb-4">
    <h3 class="">Best selling Items</h3>
    <div class="d-flex justify-content-between w-100 align-items-center">
      <a href="<?= BASE_URL . '/books' ?>" class="btn me-auto">View all items →</a>
      <div class="swiper-buttons d-flex align-items-center">
        <button class="swiper-prev product-carousel-prev me-2">
          <svg width="41" height="41"><use xlink:href="#angle-left"></use></svg>
        </button>
        <button class="swiper-next product-carousel-next">
          <svg width="41" height="41"><use xlink:href="#angle-right"></use></svg>
        </button>
      </div>
    </div>
  </div>
  <div class="swiper product-swiper">
    <div class="swiper-wrapper">
      <?php foreach ($randomBooks as $book): ?>
        <div class="swiper-slide">
          <div class="product-card">
                          <div class="offset-md-1 col-md-5">
                                <img src="<?php echo $book['book_image']; ?>" alt="product-img" class="img-fluid book-prdct mx-auto">
                            </div>
            <div class="card-detail text-center pt-3 pb-2">
              <h5 class="card-title fs-4 text-uppercase m-0">
                <a href="single-product.html"><?php echo htmlspecialchars($book['book_title']); ?></a>
              </h5>
              <span class="item-price text-primary fs-4">$<?php echo htmlspecialchars($book['book_price']); ?></span>
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
    </div>
  </div>
</section>
<section id="about">
<div class="container">
        <div class="row position-relative">
          <div class="col-lg-8">
            <div class="image-holder">
              
              <img src="<?= BASE_URL . '/assets/images/post-item3.jpg' ?>" alt="single" class="single-image img-fluid">
            </div>
          </div>
          <div class="about-content bg-gray col-lg-4 m-auto top-0 end-0 bottom-0">
          <h3 class="py-3 display-3">Abdu's Bookstore</h3>
          </div>
        </div>
      </div>
    </section>
    <!-- Footer -->
    <footer class="footer">
        <?php require_once 'layout/footer.php'; ?>
    </footer>

    <script src="<?= BASE_URL . '/assets/js/jquery-1.11.0.min.js' ?>"></script>
         <!-- Bootstrap JS -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= BASE_URL . '/assets/js/plugins.js' ?>"></script>
    <script type="text/javascript" src="<?= BASE_URL . '/assets/js/script.js' ?>"></script>
</body>
</html>
