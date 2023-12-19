<?php

//tachtig.php

declare(strict_types=1);

class Getal
{

    public function getArray() : array
    {
        $tab = array();
        $getal = rand(1, 100);
        array_push($tab, $getal);
        while ($getal <= 80) {
            $getal = rand(1, 100);
            array_push($tab, $getal);
        }
        return $tab;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tachtig</title>
    </head>
    <body>
        <pre>
            <?php
            $getal = new Getal();
            print_r($getal->getArray());
            ?>
        </pre>
    </body>
</html>
