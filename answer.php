<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
try {
$answers = getAnswers($pdo,$question_id);
} catch (PDOException $e) {
    $errors[] = "Something went wrong.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'])) {
    $errors = [];
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    
    if (empty($content)) {
        $errors[] = "Must fill answer before submit";
    }
    
    if (empty($errors) && isset($_SESSION['user_id'])) {
        try {
            $created_at = date('Y-m-d H:i:s');
            
            insertAnswer($pdo,$content, $_SESSION['user_id'], $question_id, $created_at);
            
            header("Location: question.php?id=$question_id");
            exit;
        } catch (PDOException $e) {
            $errors[] = "Database error";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_answer'])) {
    $answerId = $_POST['edit_answer'];
    $content = $_POST['edited_content'];
    if (empty($content)) {
        $errors[] = "Must fill answer before submit";
    } else {
        updateAnswer($pdo, $answerId, $content);
        header("Location: question.php?id=$question_id");
    }
}




if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_answer']))) {
    $answerId = $_POST['delete_answer'];
    
    if (!isset($_SESSION['user_id'])) {
        $errors[] = "You must be logged in to delete an answer.";
    } else {
        try {
            
            $answer = authorizeUserAnswer($pdo,$answerId);
            if (!$answer) {
                $errors[] = "Answer not found.";
            } elseif ($answer['user_id'] != $_SESSION['user_id']) {
                $errors[] = "You are not authorized to delete this answer.";
            } else {
                deleteAnswer($pdo,$answerId, $_SESSION['user_id']);
                header("Location: question.php?id=$question_id");
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Error occurred when trying to delete answer";
        }
    }
}
?>