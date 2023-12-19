<?php
//rekeningnummers.php

declare(strict_types=1);

require_once('oef8_8_Zichtrekening.php');
require_once('oef8_8_Spaarrekening.php');
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rekeningnummers</title>
    </head>
    <body>
        <h1>
            <?php
            $rek = new Zichtrekening("091-0122401-16");
            print($rek->getOmschrijving());
            ?>
            <br>
            <?php
             $spaarrek = new Spaarrekening("091-0122401-16");
            print($spaarrek->getOmschrijving());
            ?>
        </h1>
    </body>
</html>
