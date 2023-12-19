<?php

//getallenkiezen.php

declare(strict_types=1);

class Getal
{

    public function getSom(float $getal1, float $getal2) : float
    {
        $som = $getal1 + $getal2;
        return $som;
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gebruikersinvoer</title>
    </head>
    <body>
        <h1>
            <?php
            $getal = new Getal();
            $resultaat = $getal->getSom((float)$_GET["getal1"],(float)$_GET["getal2"]);
            print($resultaat);
            ?>
        </h1>

    </body>
</html>
