<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQUORA - <?= $pageTitle ?? 'Home' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient pb-3 pt-3">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa-solid fa-dragon mx-1"></i>SQUOTES</a>
            <div class="navbar-collapse ms-5" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="questions.php">All Questions</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="createQuestion.php">Ask Question</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="nav-item dropdown">
                            <a class="btn btn-outline-secondary nav-link dropdown-toggle d-flex justify-content-evenly align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <?= htmlspecialchars($_SESSION['username']) ?>
                                <i class="material-icons">person</i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                                <?php if ($_SESSION['role'] === 'admin' ?? false): ?>
                                <hr class="dropdown-divider">
                                <li><a class="dropdown-item" href="admin.php">Admin Panel</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="dropdown">
                            <a class="btn btn-outline-secondary nav-link dropdown-toggle d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="material-icons icon">person</i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="register.php">Register</a></li>
                                <li><a class="dropdown-item" href="login.php">Login</a></li>
                            </ul>
                        </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
<body>
<div class="container-fluid bg-info bg-gradient" style="min-height: calc(100vh - 56px);">
    <div class="container pb-5 pt-5">