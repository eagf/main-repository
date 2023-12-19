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

    public function getVerschil(float $getal1, float $getal2) : float
    {
        $verschil = $getal1 - $getal2;
        return $verschil;
    }

    public function getProduct(float $getal1, float $getal2) : float
    {
        $product = $getal1 * $getal2;
        return $product;
    }

    public function getQuotient(float $getal1, float $getal2) : float
    {
        $quotient = $getal1 / $getal2;
        return $quotient;
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

            if ((int)$_GET["bewerking"] === 1) {
                $resultaat = $getal->getSom((float)$_GET["getal1"],(float) $_GET["getal2"]);
            } elseif ((int)$_GET["bewerking"] === 2) {
                $resultaat = $getal->getVerschil((float)$_GET["getal1"],(float)$_GET["getal2"]);
            } elseif ((int)$_GET["bewerking"] === 3) {
                $resultaat = $getal->getProduct((float)$_GET["getal1"], (float)$_GET["getal2"]);
            } elseif ((int)$_GET["bewerking"] === 4) {
                $resultaat = $getal->getQuotient((float) $_GET["getal1"],(float) $_GET["getal2"]);
            }

            print($resultaat);
            ?>
        </h1>

    </body>
</html>
