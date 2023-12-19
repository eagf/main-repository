<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Overzicht bestellingen</title>
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css"/>
</head>

<body>
    <h1>Overzicht bestellingen</h1>
    <h3>Bestelde broodje(s):</h3>
    <?php
    if ($error) {
        ?>
        <p id='error'>
            <?php echo $error; ?>
        </p>
    <?php }

    if (isset($bestellingen)) { ?>
        <table>
            <tr>
                <th>Bestellingsnummer</th>
                <th>Besteldatum en -tijd</th>
                <th>Soort broodje</th>
                <th>Soort(en) beleg</th>
                <th>Totaalprijs</th>
            </tr>
            <?php
            foreach ($bestellingen as $bestelling) { 
                $bestelid = $bestelling->getBestelid();
                $broodje = $bestellingSrv->getBroodjeByBestelId($bestelid);
                $belegSoorten = $bestellingSrv->getBelegSoortenByBestelId($bestelid); ?>
                <tr>
                    <td>
                        <?php echo $bestelling->getBestelid() ?>
                    </td>
                    <td>
                        <?php echo $bestelling->getDatumtijd() ?>
                    </td>
                    <td>
                        <?php echo $broodje->getSoort() ?>
                    </td> 
                    <td>
                        <?php if ($belegSoorten) {
                        foreach ($belegSoorten as $beleg) {
                            echo "- " . $beleg->getSoort() . "<br>"; } 
                        } else {
                            echo "zonder beleg";
                        } ?>
                    </td>
                    <td>
                        <?php echo "€" . $bestelling->getTotaalprijs() ?>
                    </td>
                </tr>

                <?php
            } ?>
        </table>
        <?php
    }
    if (((date("H:i") >= "10:00") && $_SESSION["valseTijd"] === 0)) { ?>
        <p> Het is na 10:00, je kan nu niets meer bestellen. </p>
    <?php } else { ?>
        <br><a href="broodjeslijst.php">bestelformulier</a><br><br>
    <?php } ?>
    <br>
    <a href="bestellinglijst.php?action=valsetijd">"Voor 10:00"</a><br>
    <a href="bestellinglijst.php?action=echtetijd">Echte tijd</a><br><br><br>
    <a href="inloggen.php?action=uitloggen">uitloggen</a><br>

</body>

</html>