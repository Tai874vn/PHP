<?php include './templates/header.html.php'; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h2 class="text-center mb-3">Enter OTP</h2>

        <!-- Email Form -->
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Send OTP</button>
        </form>

        <hr>

        <!-- OTP Form -->
        <form method="post">
            <div class="mb-3">
                <label class="form-label">OTP Code</label>
                <input type="text" name="otp" class="form-control" placeholder="Enter the OTP" required>
            </div>

            <button type="submit" name="verify" class="btn btn-primary w-100">Verify OTP</button>
        </form>
    </div>
</div>

<?php include './templates/footer.html.php'; ?>
