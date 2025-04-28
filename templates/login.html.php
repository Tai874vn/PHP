<?php include './templates/header.html.php'; ?>
<?php if (!empty($errors)): ?>
            <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
        <?php endif; ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h2 class="text-center mb-3">Login</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <a href="./forgot.php" >forgot your password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="register.php">Create an account</a>
        </div>

    </div>
</div>
<?php include './templates/footer.html.php'; ?>