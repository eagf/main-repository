<?php
//bestelOverzicht.php
declare(strict_types=1);

session_start();

require_once 'BroodjesLijst.php';
require_once 'KlantenLijst.php';
require_once 'StatussenLijst.php';
require_once 'BestellingenLijst.php';

if (isset($_GET["bestelID"]) && isset($_GET["action"]) && $_GET["action"] == 'update') {
    $bestellingenClass = new BestellingenLijst();
    $bestellingenClass->updateStatus((int)$_GET["bestelID"]);
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Overzicht bestelde broodjes</title>
</head>

<body>
    <h2>Overzicht bestelde broodjes</h2>
    <?php
    $broodjeClass = new BroodjesLijst();
    $klantenClass = new KlantenLijst();
    $statussenClass = new StatussenLijst();
    $bestellingenClass = new BestellingenLijst();
    $bestellinglijst = $bestellingenClass->getLijst();
    ?>
    <table>
        <thead>
            <tr>
                <th scope="col">Broodje</th>
                <th scope="col">Klant</th>
                <th scope="col">Afhalingsmoment</th>
                <th scope="col">Gemaakt</th>
                <th scope="col">Afgehaald</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($bestellinglijst as $bestelling) {
                //if ($bestelling->getStatusID() < 3) {  //valt weg, sql aangepast controle statusid <> 3
                    ?>
                    <tr>
                        <td>
                            <?php print($bestelling->getBroodje()->getNaam()) ?>
                        </td>
                        <td>
                            <?php print($bestelling->getKlant()->getVoornaam() . " " . $bestelling->getKlant()->getAchternaam()) ?>
                        </td>
                        <td>
                            <?php print(date($bestelling->getAfhalingsmoment())) ?>
                        </td>
                        <!-- Besteld -->
                        <?php if ($bestelling->getStatusID() == 1) { ?>
                            <td>
                                <a href="bestelOverzicht.php?action=update&bestelID=<?php print($bestelling->getBestelID()) ?>">Klik</a>
                            </td>
                            <td>X</td>
                        <?php } ?>
                        <!-- Gemaakt -->
                        <?php if ($bestelling->getStatusID() == 2) { ?>
                            <td>V</td>
                            <td><a href="bestelOverzicht.php?action=update&bestelID=<?php print($bestelling->getBestelID()) ?>">Klik</a></td>
                        <?php } ?>
                    </tr>
                <?php //} 
			} ?>
        </tbody>
    </table><br>


    <a href="broodjesOverzicht.php">Terug naar 'bestellen'.</a>

</body>

</html>