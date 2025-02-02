<div class="tab-pane fade active show" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
    <form class="bg-light" action="<?= BASE_URL . '/register' ?>" method="POST" novalidate>
        <!-- Username -->
        <div class="form-group py-3">
            <label for="register-username">Username *</label>
            <input type="text" name="username" id="register-username" minlength="2" placeholder="Your Username" class="w-100" required>
            <?php if (isset($errors['username'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['username']) ?></div>
            <?php endif; ?>
        </div>
        <!-- Email -->
        <div class="form-group py-3">
            <label for="register-email">Email Address *</label>
            <input type="email" name="email" id="register-email" minlength="2" placeholder="Your Email Address" class="w-100" required>
            <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>
        <!-- Password -->
        <div class="form-group py-3">
            <label for="register-password">Password *</label>
            <input type="password" name="password" id="register-password" minlength="2" placeholder="Your Password" class="w-100" required>
            <?php if (isset($errors['password'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
            <?php endif; ?>
        </div>
        <!-- Confirm Password -->
        <div class="form-group py-3">
            <label for="register-confirm-password">Confirm Password *</label>
            <input type="password" name="confirm_password" id="register-confirm-password" minlength="2" placeholder="Confirm Your Password" class="w-100" required>
            <?php if (isset($errors['confirm_password'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errors['confirm_password']) ?></div>
            <?php endif; ?>
        </div>
        <label class="py-3">
            <input type="checkbox" required class="d-inline">
            <span class="label-body">I agree to the <a href="#" class="fw-bold">Privacy Policy</a></span>
        </label>
        <button type="submit" name="submit" class="btn btn-dark w-100 my-3">Register</button>
    </form>
</div>
