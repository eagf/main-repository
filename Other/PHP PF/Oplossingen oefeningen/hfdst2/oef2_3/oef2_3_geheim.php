<?php

//geheim.php

class Geheim {

    public function getResultaat() {
        $mijnGetal = 10;
        //Variabelennamen zijn hoofdlettergevoelig!
        $mijngetal = $mijnGetal * $mijnGetal;
        return $mijnGetal;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Geheim</title>
    </head>
    <body>
        <h1>
            <?php
            $geheim = new Geheim();
            print($geheim->getResultaat());
            ?>
        </h1>

    </body>
</html>
