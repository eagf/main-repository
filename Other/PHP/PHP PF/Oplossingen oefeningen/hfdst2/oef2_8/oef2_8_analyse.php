<?php

//analyse.php

class Oefening {

    public function getAnalyse($getal1, $getal2) {
        if ($getal1 > $getal2) {
            $antwoord = "Het eerste getal is groter dan het tweede";
        } elseif ($getal1 < $getal2) {
            $antwoord = "Het eerste getal is kleiner dan het tweede";
        } else {
            $antwoord = "Het eerste getal is gelijk aan het tweede";
        }
        return $antwoord;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Analyse</title>
    </head>
    <body>
        <h1>
            <?php
            $oef = new Oefening();
            print($oef->getAnalyse(7, 2));
            ?>
        </h1>
        <h1>
            <?php
            print($oef->getAnalyse(2, 7));
            ?>
        </h1>
        <h1>
            <?php
            print($oef->getAnalyse(7, 7));
            ?>
        </h1>

    </body>
</html>
