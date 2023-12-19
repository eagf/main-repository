<?php

//getallenarray.php

declare(strict_types=1);

class GetalArrayGenerator
{

    public function getArray() : array
    {
        $tab = array();
        $tab[0] = 0;
        $tab[1] = 1;
        for ($i = 2; $i < 30; $i++) {
            $tab[$i] = $tab[$i - 2] + $tab[$i - 1];
        }
        return $tab;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fibonaccireeks</title>
    </head>
    <body>
        <pre>
            <?php
            $arrGen = new GetalArrayGenerator();
            print_r($arrGen->getArray());
            ?>
        </pre>

    </body>
</html>
