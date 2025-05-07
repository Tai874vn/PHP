<?php

include './includes/query.php';



$question_id = $_GET['id'] ?? 0;


try {
    
    $question = getQuestion($pdo,$question_id);

    if (!$question) {
        $errors[] = ">Question not found";
        exit;
    }
    
    if ($_SESSION['user_id'] != $question['user_id']) {
        $errors[] = ">You do not have permission to edit this question";
    }
}catch (PDOException $e) {
    exit;
}


$modules = getAllModules($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $module_id = !empty($_POST['module_id']) ? $_POST['module_id'] : null;
    
    $errors = [];
    
    if (empty($title)) {
        $errors[] = "Title is required";
    }
    if (empty($content)) {
        $errors[] = "Question content is required";
    }
    
    $image = $question['image']; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_image'])) {
        $image = null;
    }


    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (in_array($file_type, $allowed_types)) {
            $image_data = file_get_contents($file_tmp);           
            $image = $image_data;
        } else {
            $errors[] = "Invalid file type. Allowed types: JPEG, PNG, GIF, WEBP";
        }
    }

    if (empty($errors)) {
        try {
            updateQuestion($pdo, $title, $content, $image, $module_id, $question_id);
            header("Location: question.php?id=$question_id");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
include './templates/edit.html.php';
?>

