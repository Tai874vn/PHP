
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './includes/query.php';

$pageTitle = "Question Detail";

$question_id = $_GET['id'] ?? 0;

try {
    $question = getQuestionDetail($pdo,$question_id);
    
    if (!$question) {
        $error[] = "Question not found";
    }
    $pageTitle = $question['title'];
} catch (PDOException $e) {
    exit;
}

if (isset($_POST['delete']) && isset($_SESSION['user_id']) && $_SESSION['user_id'] == $question['user_id']) {
    try {
        deleteQuestion($pdo,$question_id);
        header('Location: index.php');
    } catch (PDOException $e) {
        $error[] = "Failed to delete question";
    }
}


include './answer.php';


include './templates/question.html.php';
?>