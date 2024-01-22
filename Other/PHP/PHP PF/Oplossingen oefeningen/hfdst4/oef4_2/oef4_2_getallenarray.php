<?php

//getallenarray.php

declare(strict_types=1);

class GetalArrayGenerator
{

    public function getArray() : array
    {
        $tab = array();
        $tab[0] = 0;
        for ($i = 1; $i < 50; $i++) {
            $tab[$i] = $tab[$i - 1] + $i;
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
