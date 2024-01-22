<?php

declare(strict_types=1);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjes login</title>

<body>

    <h1>Broodjes login</h1>

    <form action="inloggen.php?action=process" method="post">
        <label for="email">E-mailadres: </label>
        <input type="text" name="email"><br><br>

        <label for="wachtwoord">Wachtwoord: </label>
        <input type="password" name="wachtwoord">

        <button type="submit">Inloggen</button>
    </form>
    <?php
    if ($error) {
    ?>
        <p style="color:red"><?php echo $error; ?></p>
    <?php
    }
    ?>
    <p>Nog geen account? Klik <a href="registreren.php">hier</a> om je te registreren.</p>

</body>

</html>