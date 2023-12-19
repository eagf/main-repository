<?php
//random.php

declare(strict_types=1);

session_start();



if (!isset($_SESSION["getal"])) {
    $_SESSION["getal"] = rand(1, 100);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Random</title>
    </head>
    <body>
        <?php
        print($_SESSION["getal"]);
        ?>
    </body>
</html>
