<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || (time() - $_SESSION['last_login_time']) > 604800) {
    header("Location: adminLogin.php"); 
    exit;
}

$_SESSION['last_login_time'] = time();
