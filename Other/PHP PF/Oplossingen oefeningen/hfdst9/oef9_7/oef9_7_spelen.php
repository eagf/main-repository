<?php
//spelen.php 

declare(strict_types=1);

session_start();

require_once("oef9_7_Spel.php");

$spel = new Spel();

if (isset($_GET["action"])) {
    if ($_GET["action"] === "kiesgeel") {
        $_SESSION["mijnkleur"] = 1;
    } elseif ($_GET["action"] === "kiesrood") {
        $_SESSION["mijnkleur"] = 2;
    } elseif ($_GET["action"] === "plaatsmunt") {
        $kolom = $_GET["kolom"];
        $spel->gooiMunt((int)$kolom, (int)$_SESSION["mijnkleur"]);
    } elseif ($_GET["action"] === "reset") {
        $spel->reset();
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Vier op een Rij</title>
    </head>
    <body>
        <h1>Vier op een Rij</h1>

        <table>
            <?php
            for ($rij = 1; $rij <= 6; $rij++) {
                ?>
                <tr>
                    <?php
                    for ($kolom = 1; $kolom <= 7; $kolom++) {
                        ?>
                        <td>
                            <a href="oef9_7_spelen.php?action=plaatsmunt&kolom=<?php print($kolom); ?>">
                                <?php
                                if ($spel->getStatus($rij, $kolom) === 0) {
                                    ?>
                                    <img src="oef9_7_img/emptyslot.png">
                                    <?php
                                } elseif ($spel->getStatus($rij, $kolom) === 1) {
                                    ?>
                                    <img src="oef9_7_img/yellowslot.png">
                                    <?php
                                } elseif ($spel->getStatus($rij, $kolom) === 2) {
                                    ?>
                                    <img src="oef9_7_img/redslot.png">
                                    <?php
                                }
                                ?>
                            </a>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            <?php }
            ?>
        </table>

        <p><a href="oef9_7_spelen.php">Vernieuw bord</a></p>
        <p><a href="oef9_7_spelen.php?action=reset">Spel herstarten</a></p>

    </body>
</html>
