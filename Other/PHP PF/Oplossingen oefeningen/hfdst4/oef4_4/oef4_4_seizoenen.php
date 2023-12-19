<?php

//seizoenen.php

declare(strict_types=1);

class Seizoen
{

    public function getArray() : array
    {
        $tab = array();
        array_push($tab, "Lente");
        array_push($tab, "Zomer");
        array_push($tab, "Herfst");
        array_push($tab, "Winter");
        return $tab;
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seizoenen</title>
    </head>
    <body>
        <pre>
            <?php
            $seizoenen = new Seizoen();
            print_r($seizoenen->getArray());
            ?>
        </pre>
    </body>
</html>
