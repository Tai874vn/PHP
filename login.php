<?php
include './includes/query.php';

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $errors = [];
    
    if (empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $errors[] = "Not a valid email format.";
        } else {
            $loginResult = loginUser($pdo, $email, $password);
            
            if ($loginResult === true) {
                header("Location: index.php");
                exit(); 
            } else {
                $errors[] = "Invalid email or password.";
            }
        }
    }
}

include './templates/login.html.php';
?>
