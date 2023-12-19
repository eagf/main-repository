<?php
//getallen.php

$getal1 = 20;
$getal2 = 30;

//Maak een tijdelijke variabele aan, bijv. $tmp, als tijdelijk opslagvak.
$tmp = $getal1;
$getal1 = $getal2;
$getal2 = $tmp;

print("Getal 1: " . $getal1 . "<br>");
print("Getal 2: " . $getal2);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

    </body>
</html>
