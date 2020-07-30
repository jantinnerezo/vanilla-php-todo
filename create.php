<?php
session_start();
include 'config/database.php';
include 'models/Todo.php';

$todo = new Todo($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'todo' => $_POST['todo'],
        'user_id' => $_SESSION['user_id'],
        'when_date' => $_POST['when_date']
    ];

    $todo->store($data);
    header("Location: index.php");
}

?>

<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>
<div class="container mx-auto px-4">
    <div class="w-full py-12">
        <h2 class="text-2xl font-bold mb-4"> Create New Todo </h2>
        <form action="" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="todo">
                    I want something done:
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="todo" id="todo" type="text" placeholder="To Do" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="when_date">
                    When (?)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="when_date" id="when_date" type="date" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                    Submit and Save
                </button>
            </div>
        </form>
    </div>
</div>
<?php include 'includes/footer.php' ?>