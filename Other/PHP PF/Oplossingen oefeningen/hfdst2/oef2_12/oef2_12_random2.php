<!DOCTYPE html>
<!--random2.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Random</title>
    </head>
    <body>
        <?php
        $getal = rand(1, 1000);
        while ($getal < 600) {
            print($getal . ", ");
            $getal = rand(1, 1000);
        }
        print($getal);
        ?>
    </body>
</html>
