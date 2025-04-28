<?php

include './includes/query.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    if (empty($username) || empty($password)|| empty($email) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    
    if (empty($errors)) {
        $registrationResult = registerUser($pdo, $username, $email, $password);
        if ($registrationResult === "Registration complete!") {
            header("Location: login.php");
        } else {
            $errors[] = $registrationResult;
        }
    }
}
include  './templates/register.html.php';
?>


