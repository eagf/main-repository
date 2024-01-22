<?php
//getallenarray.php
class GetalArrayGenerator
{
    public function getArray(): array
    {
        $tab = array();
        for ($i = 0; $i < 100; $i++) {
            $willekeurigGetal = rand(1, 1000);
            $tab[$i] = $willekeurigGetal;
        }
        return $tab;
    }
}
?>
<!DOCTYPE HTML>
<html>

    <head>
        <meta charset=utf-8>
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