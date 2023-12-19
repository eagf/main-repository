<?php
//spelen.php

declare(strict_types=1);

session_start();
require_once("oef9_8_Spelbord.php");

if (isset($_GET["reset"])) {
    unset($_SESSION["spelbord"]);
}

if (!isset($_SESSION["spelbord"])) {
    $spelbord = new Spelbord(4, 4);
    $_SESSION["spelbord"] = serialize($spelbord); //$spelbord is een object !
} else {
    $spelbord = unserialize($_SESSION["spelbord"]);
}

$alleLichtenZijnUit = false;
if (isset($_GET["schakelkolom"]) && isset($_GET["schakelrij"])) {
    $alleLichtenZijnUit = $spelbord->schakelOm((int)$_GET["schakelkolom"], (int) $_GET["schakelrij"]);
    $_SESSION["spelbord"] = serialize($spelbord);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lights out!</title>
    </head>
    <body>
        <h1>Lights out!</h1>

        <?php
        if ($alleLichtenZijnUit === true) {
            ?>
            <h2>U hebt gewonnen!!</h2>
            <?php
        } else {
            ?>
            <table>
                <tbody>
                    <?php
                    for ($rij = 0; $rij < $spelbord->getAantalRijen(); $rij++) {
                        ?>
                        <tr>
                            <?php
                            for ($kolom = 0; $kolom < $spelbord->getAantalKolommen(); $kolom++) {
                                ?>
                                <td>
                                    <a href="oef9_8_spelen.php?schakelkolom=<?php print($kolom); ?>&schakelrij=<?php print($rij); ?>">
                                        <?php
                                        if ($spelbord->getStatus($kolom, $rij) == 1) {
                                            ?>
                                            <img src="oef9_8_img/lightsout-aan.png" alt="licht aan" />
                                            <?php
                                        } else if ($spelbord->getStatus($kolom, $rij) == 0) {
                                            ?>
                                            <img src="oef9_8_img/lightsout-uit.png" alt="licht uit" />
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        }
        ?>
        <a href="oef9_8_spelen.php?reset=1">Nieuw spel</a>

    </body>
</html>