<header id="header" class="site-header bg-white">
    <nav id="header-nav" class="navbar navbar-expand-lg px-3">
        <div class="container">
            <button class="navbar-toggler d-flex d-lg-none ms-auto p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
                <div class="offcanvas-header px-4 pb-0">
                    <a class="navbar-brand" href="<?= BASE_URL . '/home' ?>">
                        <img src="<?= BASE_URL . '/assets/images/logo2.png' ?>" class="logo">
                    </a>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul id="navbar" class="navbar-nav w-100 d-flex justify-content-between align-items-center">
                        <ul class="list-unstyled d-lg-flex justify-content-md-between align-items-center">
                            <li class="nav-item">
                                <a class="nav-link text-uppercase ms-0 shop" href="<?= BASE_URL . '/books' ?>">Shop</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-uppercase dropdown-toggle category" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Categories<svg class="bi" width="18" height="18"><use xlink:href="#chevron-down"></use></svg></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-dark link-danger" href="<?= BASE_URL . '/books' ?>">All Categories</a></li>
                                    <?php foreach ($categories as $category): ?>
                                        <li><a class="dropdown-item text-dark link-danger" href="<?= BASE_URL . '/category/' . urlencode($category['book_genre']) ?>"><?= htmlspecialchars($category['book_genre']) ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>                  
                        </ul>
                        
                        <a class="navbar-brand d-none d-lg-block" href="<?= BASE_URL . '/home' ?>">
                            <img src="<?= BASE_URL . '/assets/images/logo2.png' ?>" class="logo">
                        </a>

                        <ul class="list-unstyled d-lg-flex justify-content-between align-items-center">
                            <li class="nav-item search-item search">
                                <div id="search-bar" class="d-none d-lg-block glow-red rounded-2">
                                    <form method="GET" action="<?= BASE_URL . '/books' ?>" class="position-relative d-flex justify-content-between align-items-center py-1">
                                        <input class="search-field link-danger" name="search" placeholder="Search" type="search" value="<?= htmlspecialchars($keyword) ?>">
                                        <button type="submit" class="btn btn-link p-0 border-0">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item account">
                                <?php if ($isLoggedIn): ?>
                                    <a class="nav-link text-uppercase me-0" href="<?= BASE_URL . '/logout' ?>">Logout</a>
                                <?php else: ?>
                                    <a class="nav-link text-uppercase me-0" href="<?= BASE_URL . '/login' ?>">Sign-in / Register</a>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item cart">
                                <a class="nav-link text-uppercase me-0" href="<?= BASE_URL . '/cart' ?>">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>
                            <?php if ($isLoggedIn): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-uppercase me-0 orders" href="<?= BASE_URL . '/orders' ?>">My Orders</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
