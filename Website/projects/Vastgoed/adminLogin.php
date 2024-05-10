<?php

declare(strict_types=1);
require_once('data/autoloader.php');

session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php"); 
    exit;
}

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password']; 
    if ($password == "testtest") { 
        $_SESSION['admin_logged_in'] = true; 
        $_SESSION['last_login_time'] = time();
        header("Location: admin.php"); 
        exit;
    } else {
        $error_message = "Incorrect Password!";
    }
}


include("presentation/adminLoginPresentation.php");