<?php
//gastenBoekForm.php

declare(strict_types=1);

require_once("oef9_5_GastenBoek.php");

$gb = new GastenBoek();
if (isset($_GET["action"]) && $_GET["action"] === "create") { 
    $auteur = $_POST["auteur"];
    $boodschap = $_POST["boodschap"];
    
    if (!empty($auteur) && !empty($boodschap)) {
        $gb->createBericht($auteur, $boodschap);
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>GastenBoek</title>
    </head>
    <body>

        <h1>Berichten</h1>

        <?php
        $berichten = $gb->getAlleBerichten();
        ?>

        <ul>
            <?php
            foreach ($berichten as $bericht) {
                ?>
                <p>
                    <strong>Auteur:</strong> <?php print($bericht->getAuteur()); ?>
                    <br />
                    <em><?php print($bericht->getBoodschap()); ?></em>
                </p>
                <hr />
                <?php
            }
            ?>
        </ul>

        <h1>Bericht toevoegen</h1>
        
        <form method="post" action="oef9_5_gastenBoekForm.php?action=create">
            <p><strong>Auteur:</strong> <input type="text" name="auteur" /></p>
            <p><strong>Boodschap:</strong><br />
                <textarea name="boodschap" cols="50" rows="4"></textarea>
                <!--<textarea name="boodschap" cols="50" rows="4" maxlength="200"></textarea>-->
            </p>
            
            <input type="submit" value="Verzenden" />
        </form>

    </body>
</html>
