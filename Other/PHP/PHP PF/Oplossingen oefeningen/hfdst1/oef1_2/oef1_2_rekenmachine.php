<?php

//rekenmachine.php

class Rekenmachine {

    public function getKwadraat($getal) {
        $kwad = $getal * $getal;
        return $kwad;
    }

    public function getSom($getal1, $getal2) {
        $resultaat = $getal1 + $getal2;
        return $resultaat;
    }

    
	// de logica-laag werd aangepast
	public function getProduct($getal1, $getal2) {
        $resultaat = $getal1 * $getal2;
        return $resultaat;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rekenmachine</title>
    </head>
    <body>
        <h1>
            <?php
            $reken = new Rekenmachine();
            print($reken->getKwadraat(5));
            ?>
        </h1>

        <h1>
            <?php
            print($reken->getSom(65, 8));
            ?>
            <br>
            <?php
            print($reken->getSom(34, 55));
            ?>
        </h1>
		<h1>
            <?php
			//als je de nieuwe functie wil uitproberen, pas je ook de presentatielaag aan
            print($reken->getProduct(34, 55));
            ?>
		</h1>

    </body>
</html>
