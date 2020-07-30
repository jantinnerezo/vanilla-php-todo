<?php

include 'config/database.php';

$users_table = "CREATE TABLE `users` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50),
    `email` VARCHAR(50),
    `password` VARCHAR(199),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;";

$todos_table = "CREATE TABLE `todos` (
    `id` INT(10) NOT NULL AUTO_INCREMENT,
    `todo` VARCHAR(199),
    `user_id` INT(10) unsigned,
    `when_date` DATETIME,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;";

try {
    $pdo->exec($users_table);
    $pdo->exec($todos_table);

    echo "Created users and todos table successfully! go on my friend.";
} catch (PDOException $e) {
    echo "Did you follow the usage (?)";
    echo $e->getMessage();
}
