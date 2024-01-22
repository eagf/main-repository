<!DOCTYPE html>
<!--random1.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Random</title>
    </head>
    <body>
        <?php
        $willekeurig = rand(10, 20);
        for ($var = 1; $var <= $willekeurig; $var++) {
            print($var . " ");
        }
        ?>
    </body>
</html>
