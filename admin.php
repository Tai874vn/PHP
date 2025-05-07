<?php 
include './includes/query.php';


if ($_SESSION['role'] != 'admin') {   
    $errors [] =  "You do not have permission to access this feature";
    exit;
    } else {
        $users = getUsers($pdo);
        $questions = getAllQuestion($pdo);
        $modules = getAllModules($pdo);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['edit_user'])) {
    $user_id = $_POST['edit_user'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = ($_POST['password']);
    if (empty($username)|| empty($email)) {
        $error[] = "All fields are required.";
    } else {
        updateUser($pdo, $username, $email, $password, $user_id);
        header("Location:admin.php");
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    deleteUser($pdo,$user_id);
    header("Location:admin.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question_id'])) {
    $user_id = $_POST['user_id'];
    $question_id = $_POST['question_id'];
    $module_id = $_POST['module_id'];
    updateQuestionAndModule($pdo, $user_id, $module_id, $question_id);
    header("Location:admin.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = ($_POST['password']);
    $confirm_password = ($_POST['newConfirmPassword']);

    $errors = [];

    if (empty($username) || empty($password)|| empty($email) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (empty($errors)) {
        $registrationResult = registerUser($pdo,$username,$email,$password);
        if ($registrationResult === "Registration complete!") {
            header("Location: admin.php");
        } else {
            $errors[] = $registrationResult;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_module'])) {
    $module_name = $_POST['module_name'];
    if (empty($module_name)) {
        $errors[] = "Module name must be filled.";
    }
    $result = addModule($pdo,$module_name);
    if ($result === "New module added") {
        header("Location: admin.php");
    } else {
        $errors[] = $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_module'])) {
    $module_name = $_POST['edit_module_name'];
    if (empty($module_name)) {
        $errors[] = "Module name must be filled.";
    }
    $module_id = $_POST['module_id'];
    $result = editModule($pdo,$module_name,$module_id);
    if ($result === "Module name changed") {
        header("Location: admin.php");
    } else {
        $errors[] = $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_module'])) {
    $module_id = $_POST['module_id'];
    $result = deleteModule($pdo,$module_id);
    if ($result === "Module deleted.") {
        header("Location: admin.php");
    } else {
        $errors[] = $result;
    }
}

include './templates/admin.html.php';?>