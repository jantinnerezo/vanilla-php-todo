<?php

$host = "localhost";
$database_name = "todo_db";
$username = "root";
$password = "#1997#";

$options = array(
    PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

try {
    $connection = "mysql:host={$host};dbname={$database_name};charset=utf8mb4";
    $pdo = new PDO($connection, $username, $password, $options);
} catch (PDOException $e) {
    echo $e->getMessage();
}
