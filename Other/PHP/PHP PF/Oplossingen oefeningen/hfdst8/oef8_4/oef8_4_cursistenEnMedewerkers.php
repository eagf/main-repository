<?php
//cursistenEnMedewerkers.php

declare(strict_types=1);

require_once ('oef8_4_Medewerker.php');
require_once ('oef8_4_Cursist.php');

$cursist = new Cursist();
$medewerker = new Medewerker();
$cursist->setFamilienaam("Peeters");
$cursist->setVoornaam("Jan");
$medewerker->setFamilienaam("Janssens");
$medewerker->setVoornaam("Tom");
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cursisten en medewerkers</title>
    </head>
    <body>
        <h1>Namen</h1>
        <ul>
            <li><?php print($cursist->getVollNaam()); ?></li>
            <li><?php print($medewerker->getVollNaam()); ?></li>
        </ul>
    </body>
</html>
