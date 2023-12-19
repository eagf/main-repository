<?php
//spelen.php

declare(strict_types=1);

require_once("Spel.php");
$kleur = (int) $_GET["kleur"];
$test = new Veld();

if (isset($_GET["kolom"])) {
    $test->updateVeld((int) $_GET["kolom"], $kleur);
    if ($kleur === 1) {
        $kleur = 2;
    } else {
        $kleur = 1;
    }
}
;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vier op een rij</title>
    <style>
        #geel {
            text-shadow: 1px 1px black;
            color: yellow;
        }
        #rood { 
            text-shadow: 1px 1px black;
            color: red;
        }
    </style>
</head>

<body>
    <h1>Vier op een Rij</h1>
    <?php
    $teller = 1;
    $veld = $test->getVeld();
    foreach ($veld as $plaats) {
        print("<a href='spelen.php?kleur=" . $kleur . "&kolom=" . $plaats->getKolomnummer() . "'>");
        if ($plaats->getStatus() === 0) {
            print("<img src='oef9_7_img/emptyslot.png'></a>");
        } elseif ($plaats->getStatus() === 1) {
            print("<img src='oef9_7_img/yellowslot.png'>");
        } else {
            print("<img src='oef9_7_img/redslot.png'>");
        }
        print("</a>");
        $teller++;
        if ($teller === 8) {
            print("<br>");
            $teller = 1;
        }
    }
    if ($kleur === 1) {
        print("<h2 id='geel'>Geel</h2> <h2> is aan de beurt.</h2>");
    } else {
        print("<h2 id='rood'>Rood</h2> <h2> is aan de beurt.</h2>");
    }

    ?>
    <br><br>
    <a href="kleurKiezen.php"><img src="oef9_7_img/reset.png" width="20"></a>

</body>

</html>