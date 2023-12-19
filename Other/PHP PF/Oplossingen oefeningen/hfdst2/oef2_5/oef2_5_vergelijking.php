<?php

//vergelijking.php

class Vergelijking {

    public function getSomIsStriktPositief($getal1, $getal2) {
        $antw = (($getal1 + $getal2) > 0);
        if ($antw === true) {
            return "JA";
        } else {
            return "NEEN";
        }
    }

    public function getSomIsStriktNegatief($getal1, $getal2, $getal3) {
        $antw = (($getal1 + $getal2 + $getal3) < 0);
        if ($antw === true) {
            return "JA";
        } else {
            return "NEEN";
        }
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vergelijking</title>
    </head>
    <body>
        <h1>
            <?php
            $vgl = new Vergelijking();
            print($vgl->getSomIsStriktPositief(10, -9));
            ?>
        </h1>
        <h1>
            <?php
            print($vgl->getSomIsStriktNegatief(10, -9, -7));
            ?>
        </h1>
        <h1>
            <?php
            print($vgl->getSomIsStriktNegatief(10, -2, -7));
            ?>
        </h1>
    </body>
</html>
