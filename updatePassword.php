<?php
include './includes/query.php';

try {
    if ($_SESSION['verify'] != true) {
        echo '<div class="alert alert-danger">You do not have permission to enter this page</div>';
        exit;
    }
}catch (PDOException $e) {
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['updatePassword'])) {
    $email = $_SESSION['email'];
    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];
    $errors = [];

    if (empty($password)|| empty($email) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    $result = updatePassword($pdo,$email,$confirm_password);
    if ($result === "Password changed!") {
        header("Location: login.php");
    } else {
        echo "<script>alert('$result');</script>";
    }

}

include './templates/updatePassword.html.php';


?>