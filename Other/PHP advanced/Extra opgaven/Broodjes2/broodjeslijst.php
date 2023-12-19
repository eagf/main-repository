<?php
declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;
use Business\BroodjeService;
use Business\BelegService;
use Business\BestellingService;
use Exceptions\GeenBestellingenException;
use Exceptions\TeLaatException;

if (!isset($_SESSION["klant"])) {
    header("location: inloggen.php");
    exit(0);
}

if (isset($_GET["action"]) && ($_GET["action"]) === "valsetijd") {
    $_SESSION["valseTijd"] = 1;
}
elseif (isset($_GET["action"]) && ($_GET["action"]) === "echtetijd") {
    $_SESSION["valseTijd"] = 0;
} 

$error = "";
$broodjeSrv = new BroodjeService();
$broodjeslijst = $broodjeSrv->getAll();
$belegSrv = new BelegService();
$beleglijst = $belegSrv->getAll();
if (isset($_GET["action"]) && ($_GET["action"]) === "process") {
    try {
        $bestellingSrv = new BestellingService();
        $belegSoorten = array();
        foreach ($beleglijst as $beleg) {
            if (isset($_POST[$beleg->getBelegid()])) {
                array_push($belegSoorten, (int)$_POST[$beleg->getBelegid()]);
            }
        }
        $bestellingSrv->create(
            unserialize($_SESSION["klant"])->getKlantid(), 
            (int) $_POST["selBroodje"], 
            (array) $belegSoorten, 
            (int) $_SESSION["valseTijd"]
        );
        header("location: broodjeslijst.php?action=besteld");
    } catch (TeLaatException $e) {
        $error = "Je kan niet meer bestellen aangezien het later dan 10:00 is.";
    }
}

if (((date("H:i") >= "10:00") && $_SESSION["valseTijd"] === 0)) {
    header("location: bestellinglijst.php");
}

include("Presentation/broodjeslijstForm.php");
