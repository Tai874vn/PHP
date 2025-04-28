<?php
include './includes/query.php';

$modules = getAllModules($pdo); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $image = $_POST['image'] ?? '';
    $module_id = !empty($_POST['module_id']) ? $_POST['module_id'] : null;
    $errors = [];
    

    if (empty($title)) {
        $errors[] = "Title is required";
    }
    if (empty($content)) {
        $errors[] = "Question content is required";
    }
    

    if (empty($errors)) {
        try {
            $imageData = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                if (in_array($file_type, $allowed_types)) {
                    $image_data = file_get_contents($file_tmp);
                    $imageData = $image_data;
                } else {
                    $errors[] = "Invalid file type. Allowed types: JPEG, PNG, GIF, JPG";
                }
            }

            $question_id = insertQuestion($pdo, $title, $content, $imageData, $_SESSION['user_id'], $module_id);

            header("Location: question.php?id=$question_id");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}


include './templates/createQuestion.html.php';
?>


