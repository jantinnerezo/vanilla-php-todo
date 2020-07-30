<?php

session_start();

session_unset('user_id');
session_destroy();

header("Location: login.php");
