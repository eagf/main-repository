<?php

//oneven_even.php

declare(strict_types=1);

class GetalArrayGenerator
{

    public function getArray() : array
    {
        $tab = array();
        for ($i = 1; $i <= 50; $i += 2) {
            array_push($tab, $i);
        }
        for ($i = 2; $i <= 50; $i += 2) {
            array_push($tab, $i);
        }
        return $tab;
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Oneven-Even</title>
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
