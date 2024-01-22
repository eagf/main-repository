<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<!--gok.php-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gok</title>
    </head>
    <body>
        <?php
        $getal = rand(1, 10);
        $gok = (int) $_GET["mijngok"];
        
        print("Gezochte getal: " . $getal . "<br />");
        print("Uw gok: " . $gok . "<br /><br />");
        
        if ($getal === $gok) {
            print("Het getal is geraden!");
        } else {
            print("U hebt verkeerd gegokt!");
        }
        ?>
    </body>
</html>
