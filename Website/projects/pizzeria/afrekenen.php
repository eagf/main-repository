<?php

declare(strict_types=1);
require_once('Data/autoloader.php');

session_start();

$error = "";
$productSrv = new ProductService();
$bestellingSrv = new BestellingService();
$klantSrv = new KlantService();
$plaatsSrv = new PlaatsService();

if (isset($_SESSION["klant"])) {
    $klant = unserialize($_SESSION["klant"]);
    $klantPromo = $klant->getKlantPromo();
    $plaats = $plaatsSrv->getPlaatsByKlantId($klant->getKlantId());
    $leverbaar = $plaats->getIsLeverbaar();
} else {
    header("location: inloggen.php");
}

if (isset($_GET["action"]) && $_GET["action"] === "toggleKlantPromo") {
    $klant = $klantSrv->toggleKlantPromoByKlantId($klant->getKlantId());
    $_SESSION["klantId"] = $klant->getKlantId();
    $_SESSION["naam"] = $klant->getKlantNaam();
    $_SESSION["voornaam"] = $klant->getKlantVoornaam();
    $_SESSION["straat"] = $klant->getKlantStraat();
    $_SESSION["huisnummer"] = $klant->getKlantHuisnummer();
    $_SESSION["postcode"] = $plaatsSrv->getPlaatsByKlantId($klant->getKlantId())->getPostcode();
    $_SESSION["telefoonnummer"] = $klant->getKlantTelefoonnummer();
    if ($klant->getKlantEmail() !== "0") {
    $_SESSION["email"] = $klant->getKlantEmail();
    }
    $_SESSION["info"] = $klant->getKlantInfo();
    $klantPromo = $klant->getKlantPromo();
    $_SESSION["klant"] = serialize($klant);
    header("location: afrekenen.php");
}

if (!isset($_SESSION["winkelmand"])) {
    $_SESSION["winkelmand"] = serialize(array());
}
$winkelmandLijst = unserialize($_SESSION["winkelmand"]);

if (isset($_GET["action"]) && $_GET["action"] === "process" && $leverbaar === 1) {
    $bestellingSrv->createBestelling(
        $klant,
        $_POST["txtBestelInfo"],
        $winkelmandLijst
    );
    header("location: afrekenen.php?action=besteld");
}

if (isset($_GET["action"]) && $_GET["action"] === "besteld") {
    $_SESSION["winkelmand"] = serialize(array());
    $winkelmandLijst = unserialize($_SESSION["winkelmand"]);
}

include("Presentation/afrekenenPresentation.php");
