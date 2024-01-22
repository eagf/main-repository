<?php

//getallenarray.php

declare(strict_types=1);

class GetalArrayGenerator
{

    public function getArray() : array
    {
        $tab = array();
        for ($i = 0; $i < 20; $i++) {
            $willekeurigGetal = rand(-50, 50);
            $tab[$i] = $willekeurigGetal;
        }
        return $tab;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Willekeurige getallen</title>
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
