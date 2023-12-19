<?php

//switch.php

class Oefening {

    public function getWaarde($getal) {
        switch ($getal) {
            case 1:
                return "Een";
                break;

            case 2:
                return "Twee";
                break;

            case 3:
                return "Drie";
                break;

            case 4:
                return "Vier";
                break;

            case 5:
                return "Vijf";
                break;

            default:
                return $getal;
                break;
        }
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Switch</title>
    </head>
    <body>
        <h1>
            <?php
            $oef = new Oefening();
            print($oef->getWaarde(2));
            ?>
            <br />
            <?php
            print($oef->getWaarde(5));
            ?>
            <br />
            <?php
            print($oef->getWaarde(6));
            ?>
        </h1>
    </body>
</html>
