<?php
//tellen.php

declare(strict_types=1);

session_start();

if (!isset($_SESSION["teller"])) {
    $_SESSION["teller"] = 0;
} else {
    $_SESSION["teller"] ++;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tellen</title>
    </head>
    <body>
        <?php
        print($_SESSION["teller"]);
        ?>
    </body>
</html>
