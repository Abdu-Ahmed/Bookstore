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
                <h1>Account</h1>
                <div class="breadcrumbs">
                    <span class="item">
                        <a href="<?= BASE_URL ?>">Home &gt;</a>
                    </span>
                    <span class="item">Account</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <section class="login-tabs padding-xlarge">
        <div class="container">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link fw-light text-uppercase active" id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab" aria-controls="nav-sign-in" aria-selected="true">Login</button>
                            <button class="nav-link fw-light text-uppercase" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">Register</button>
                        </div>
                    </nav>
                    <div class="bg-gray tab-content" id="nav-tabContent">
                        <!-- Login Tab Content -->
                        <div class="tab-pane fade show active" id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
                            <?php require_once 'partials/Login.php'; ?>
                        </div>
                        <!-- Register Tab Content -->
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                            <?php require_once 'partials/Register.php'; ?>
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
