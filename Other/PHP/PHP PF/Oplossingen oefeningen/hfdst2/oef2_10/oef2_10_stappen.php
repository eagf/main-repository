<!DOCTYPE html>
<!--stappen.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lussen</title>
    </head>
    <body>
        <h1>Stappen van 1 :</h1>
        <?php
        for ($var = 20; $var <= 50; $var++) {
            print($var . " ");
        }
        ?>
        <br />

        <h1>Stappen van 2 :</h1>
        <?php
        for ($var = 20; $var <= 50; $var += 2) {
            print($var . " ");
        }
        ?>
    </body>
</html>
