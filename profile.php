<?php

include './includes/databaseConnection.php';
$stmt = $pdo->query('
    SELECT * FROM users
');
$questions = $stmt->fetchAll();
include './templates/profile.html.php';

?>