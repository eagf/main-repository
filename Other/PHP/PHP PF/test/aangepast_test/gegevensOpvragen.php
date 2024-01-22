<?php
//gegevensOpvragen.php
declare(strict_types=1);

session_start();

require_once 'BroodjesLijst.php';
require_once 'KlantenLijst.php';
require_once 'BestellingenLijst.php';

if (isset($_GET["broodjeID"])) {
    $_SESSION["broodjeID"] = $_GET["broodjeID"];
}

$klantenClass = new KlantenLijst();

/*
if (isset($_POST["email"])) {
    $controleKlant = $klantenClass->controleKlant($_POST["email"]);
    if ($controleKlant == false) {
        $_SESSION["controleKlant"] = false;
        header('Location: gegevensOpvragen.php');
    } else {
        $_SESSION["controleKlant"] = true;
    }
}
*/
$_SESSION["controleKlant"] = true;  // TIJDELIJK
// NOG AAN TE PASSEN: als het formulier gepost wordt, controleer of het emailadres bestaat, insert de klant (vraag lastinsertedid op), insert de bestelling

if (isset($_GET["nieuweKlant"]) && (int) $_GET["nieuweKlant"] == 1) {
    $_SESSION["controleKlant"] = true;
    if (!$klantenClass->controleEmail($_POST["emailNieuw"])) {
        $_SESSION["controleEmail"] = true;
        $klantenClass->nieuweKlant($_POST["voornaamNieuw"], $_POST["achternaamNieuw"], $_POST["emailNieuw"]);
    } else {
        $_SESSION["controleEmail"] = false;
        header('Location: registratieKlant.php');
    }
}

if (isset($_SESSION["controleKlant"]) && $_SESSION["controleKlant"] == true && isset($_SESSION["broodjeID"]) && isset($_GET["action"]) && $_GET["action"] == "besteld") {
    $klantenClass = new KlantenLijst();
    $bestellingenClass = new BestellingenLijst();
    //$bestellingenClass->createBestelling((int) $klantenClass->getIDKlant($_POST["email"]), (int) $_SESSION["broodjeID"], $_POST["dag"]);
	// datum en uur opnieuw samenvoegen
	$datumuur = $_POST["datum"].' '.$_POST["uur"];
	$bestellingenClass->createBestelling((int) $klantenClass->getIDKlant($_POST["email"]), (int) $_SESSION["broodjeID"], $datumuur);
    unset($_SESSION["controleEmail"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gegevens</title>
</head>

<body>
    <h2>Gegevens ingeven</h2>
    <div>
        <form action="gegevensOpvragen.php?action=besteld" method="post">
            <label for="voornaam">Voornaam:</label>
            <input type="text" id="voornaam" name="voornaam" required><br><br>  <!--  required toegevoegd  -->
            <label for="achternaam">Achternaam:</label>
            <input type="text" id="achternaam" name="achternaam" required><br><br> <!--  required toegevoegd  -->
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required><br><br>
            <label for="dag">Dag:</label>
<!--     datum en uur opgesplistst  			-->
Datum: <input type="date" name="datum" value="<?php print date('Y-m-d'); ?>" min="<?php print date('Y-m-d'); ?>" required><br><br>
Uur: <input type="time" name="uur" value="<?php print date('H:i', strtotime("+30 minutes")); ?>" min="<?php print date('H:i', strtotime("+30 minutes")); ?>" required>			
			<br><br>
            <input type="submit" value="Plaats bestelling">
        </form><br>
    </div>

   
    <br>

    <h3>Geselecteerde broodje:
        <?php
        if (isset($_SESSION["broodjeID"])) {
            $broodjeClass = new BroodjesLijst();
            print($broodjeClass->getBroodjeByNaam((int) $_SESSION["broodjeID"]));
        } else {
            print("Geen broodje geselecteerd.");
        }
        ?>
    </h3>
    <a href="broodjesOverzicht.php">Ander broodje kiezen</a><br><br><br>
    <a href="bestelOverzicht.php">Besteloverzicht</a>
</body>

</html>