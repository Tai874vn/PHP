<?php include './templates/header.html.php'; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h2 class="text-center mb-3">Reset Password</h2>

        <!-- New Password form-->
        <form method="post">
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm your password">
            </div>

            <button type="submit" name="updatePassword" class="btn btn-primary w-100">Reset Password</button>
        </form>

        <div class="text-center mt-3">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</div>

<?php include './templates/footer.html.php'; ?>
