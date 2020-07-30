<?php
session_start();
include 'config/database.php';
include 'models/Todo.php';

$todo = new Todo($pdo);
$user_id = $_SESSION['user_id'];

if (!$user_id) {
    header("Location: login.php");
}

$list = $todo->index($user_id);

?>

<?php include 'includes/header.php' ?>
<?php include 'includes/navbar.php' ?>
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 gap-6 py-12">
        <div class="flex items-center justify-end">
            <a href="create.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 w-full">
            <div class="col-span-1 md:col-span-4 col-start-1 md:col-start-2">
                <ul class="grid grid-cols-1 gap-4">
                    <?php foreach ($list as $todo) : ?>
                        <?php $date = strtotime($todo['when_date']); ?>
                        <li>
                            <div class="flex border py-2 px-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-gray-500 text-white">
                                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                            <path d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 w-full">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900">
                                        <?php echo $todo['todo']; ?>
                                    </h4>
                                    <p class="mt-2 text-base leading-6 text-gray-500">
                                        <?php echo date('F j, Y h:i a', $date); ?>
                                    </p>
                                    <div class="flex items-center space-x-2 justify-end">
                                        <a href="edit.php?id=<?php echo $todo['id'] ?>" class="font-medium text-blue-500 hover:text-blue-700 px-4 py-2"> Edit </a>
                                        <a href="destroy.php?id=<?php echo $todo['id'] ?>" class="font-medium text-red-500 hover:text-red-700 px-4 py-2"> Delete </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php' ?>