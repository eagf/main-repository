<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <title>Admin login</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <form method="post">
            Password: <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
        if (!empty($error_message)) {
            echo '<p>' . $error_message . '</p>';
        }
        ?>

    </div>
</body>