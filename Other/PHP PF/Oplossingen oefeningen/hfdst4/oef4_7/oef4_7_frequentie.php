<?php

//frequentie.php

declare(strict_types=1);


class Frequentie
{

    public function getArray() : array
    {
        $tab = array();
        for ($i = 1; $i <= 40; $i++) {
            $tab[$i] = 0;
        }
        for ($i = 0; $i < 100; $i++) {
            $getal = rand(1, 40);
            $tab[$getal]++;
        }
        return $tab;
    }

}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Frequentie</title>
    </head>
    <body>
        <?php
        $freq = new Frequentie();
        $tab = $freq->getArray();
        for ($i = 1; $i <= 40; $i++) {
            ?>
            Getal <?php print($i); ?> werd <?php print($tab[$i]); ?> keer gegenereerd.<br>
            <?php

        }
        ?>
    </body>
</html>
