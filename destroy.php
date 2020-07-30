<?php
session_start();
include 'config/database.php';
include 'models/Todo.php';

$todo = new Todo($pdo);
$id = $_GET['id'];
$data = $todo->show($id);

if (!$data) {
    http_response_code(404);
    return;
}

if ($data['user_id'] === $_SESSION['user_id']) {
    $todo->destroy($data['id']);
    header("Location: index.php");
} else {
    echo 'You are not allowed to delete this todo.';
}
