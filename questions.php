<?php 
include './includes/query.php';

$searchTitle = $_GET['search'] ?? '';

if (!empty($searchTitle)) {
    $allQuestions = searchQuestions($pdo, $searchTitle);
} else {
    $allQuestions = getAllQuestion($pdo);
}

include './templates/questions.html.php';
?>