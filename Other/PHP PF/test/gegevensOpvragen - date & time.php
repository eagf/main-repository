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

if (isset($_POST["email"])) {
    $controleKlant = $klantenClass->controleKlant($_POST["email"]);
    if ($controleKlant == false) {
        $_SESSION["controleKlant"] = false;
        header('Location: gegevensOpvragen.php');
    } else {
        $_SESSION["controleKlant"] = true;
    }
}

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
    $dateTime = $_POST["dag"] . " " . $_POST["tijd"];
    $bestellingenClass->createBestelling((int) $klantenClass->getIDKlant($_POST["email"]), (int) $_SESSION["broodjeID"], $dateTime);
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
            <input type="text" id="voornaam" name="voornaam"><br><br>
            <label for="achternaam">Achternaam:</label>
            <input type="text" id="achternaam" name="achternaam"><br><br>
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required><br><br>
            <label for="dag">Dag:</label>
            <input type="date" id="dag" name="dag" value="<?php print(date('Y-m-d')); ?>" min="<?php print(date('Y-m-d')); ?>" required><br><br>
            <label for="tijd">Tijd:</label>
            <input type="time" id="tijd" name="tijd" value="<?php print(date('H:i', strtotime('+30 minutes'))); ?>" min="<?php print(date('H:i', strtotime('+30 minutes'))); ?>" required><br><br>
            <input type="submit" value="Plaats bestelling">
        </form><br>
    </div>
    <?php
    if (isset($_SESSION["controleKlant"]) && $_SESSION["controleKlant"] == false) { ?>
        <p style='color:red'>Je bent nog niet geregistreerd.</p>
        <p>Klik <a href='registratieKlant.php'>hier</a> om je te registeren.
        <?php } elseif (isset($_GET["nieuweKlant"]) && (int) $_GET["nieuweKlant"] == 1) { ?>
        <p>Je bent succesvol geregistreerd! Je kan nu inloggen om te kunnen bestellen.</p>
    <?php } else { ?>
        <p>Nog geen gebruiker? Klik dan
            <a href='registratieKlant.php'> hier</a> om je te registeren.
        </p>
    <?php }
    unset($_POST["email"]);
    ?>
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