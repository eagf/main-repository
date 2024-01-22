<?php
//chatForm.php

declare(strict_types=1);

session_start();

require_once("oef9_6_BerichtenLijst.php");

$berichtenLijst = new BerichtenLijst();

/* plaats in commentaar voor 'EXTRA' */
if (!isset($_SESSION["nickname"])) {
    $getal = rand(111, 999);
    $_SESSION["nickname"] = "p" . $getal;
}

/* EXTRA */
//if (isset($_GET["action"]) && $_GET["action"] === "newnick") {
//    $_SESSION["nickname"] = $_POST['nickname'];
//}

if (isset($_GET["action"]) && $_GET["action"] === "add") {
    $berichtenLijst->createBericht($_SESSION["nickname"], $_POST["txtBoodschap"]);
}

$berichten = $berichtenLijst->getAlleBerichten();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>chatForm</title>
    </head>
    <body>
        
        <!-- EXTRA -->
        <?php
        // if (!isset($_SESSION["nickname"])) {
            ?>
        <!--
            <h1>Nickname</h1>

            <form method="post" action="oef9_6_chatForm.php?action=newnick">
                <label>Nickname : <input type="text" name="nickname" /></label>

                <input type="submit" value="Versturen" />
            </form>
        -->
            <?php
       // }
        ?>
        
        <h1>Berichten</h1>

        <table style="width: 500px;">
            <tbody>
                <?php
                foreach ($berichten as $bericht) {
                    ?>
                    <tr>
                        <td style="width: 150px;">
                            <?php print($bericht->getNickname()); ?> >
                        </td>
                        <td>
                            <?php print($bericht->getBoodschap()); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <br>
        <br>

        <?php
        /* EXTRA */
        //if (isset($_SESSION["nickname"])) {
            ?>
            <form method="post" action="oef9_6_chatForm.php?action=add">
                Bericht:<br />
                <textarea name="txtBoodschap" cols="60" rows="3"></textarea> <br />
                <input type="submit" value="Versturen" />
            </form>
            <?php
        //}
        ?>
    </body>
</html>
