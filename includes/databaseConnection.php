<?php
$host = 'localhost';
$dbname = 'CW';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn,'root','');
} catch (PDOException $e) {
    $output = "Unable to connect to the database server: ";
}
?>
