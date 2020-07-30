<?php

session_start();
include 'config/database.php';
include 'models/User.php';

$user = new User($pdo);

$error = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $id = $user->authenticate($email, $password);

    if ($id) {
        $_SESSION['user_id'] = $id;
        header("Location: index.php");
    } else {
        $error = true;
    }
}

?>

<?php include 'includes/header.php' ?>
<div class="container mx-auto px-4">
    <div class="w-full py-12">
        <form action="" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <?php if ($error) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">Email or password is incorrect!</span>
                </div>
            <?php endif; ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" id="email" type="email" placeholder="Email" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <button class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Login
                </button>
                <a href="register.php" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline text-center" type="submit">
                    Register
                </a>
            </div>
        </form>
    </div>
</div>
<?php include 'includes/footer.php' ?>