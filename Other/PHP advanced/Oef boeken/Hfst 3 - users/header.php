<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gebruikerstoegang</title>
</head>

<body>
    <a href="index.php">Home</a> -
    <a href="publicpage.php">Public page</a> -
    <?php
    if (!isset($_SESSION["gebruiker"])) {
    ?>
        <a href="login.php">Login</a> -
        <a href="register.php">Registreren</a>
    <?php
    } else {
    ?>
        <a href="privatepage.php">Private page</a> -
        <a href="logout.php">Logout</a>
    <?php
    }
    ?>