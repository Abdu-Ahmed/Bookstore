<form class="bg-light" action="<?= BASE_URL . '/login' ?>" method="POST" novalidate>
    <!-- username -->
    <div class="form-outline mb-4">
        <label for="login-username" class="form-label">Username:</label>
        <input type="text" name="username" id="login-username" class="form-control" placeholder="Enter username" required>
        <?php if (isset($errors['username'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['username']) ?></div>
        <?php endif; ?>
    </div>
    <!-- password -->
    <div class="form-outline mb-4">
        <label for="login-password" class="form-label">Password:</label>
        <input type="password" name="password" id="login-password" class="form-control" placeholder="Enter password" required>
        <?php if (isset($errors['password'])): ?>
            <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
        <?php endif; ?>
    </div>
    <label class="py-3">
        <input type="checkbox" class="d-inline">
        <span class="label-body">Remember Me</span>
        <span class="label-body"><a href="#" class="fw-bold">Forgot Password</a></span>
    </label>
    <button type="submit" class="btn btn-dark w-100 my-3">Login</button>
</form>
