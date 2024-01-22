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
if (isset($_GET["action"]) && ($_GET["action"]) === "echtetijd") {
    $_SESSION["valseTijd"] = 0;
} 

$error = "";
try {
    $bestellingSrv = new BestellingService();
    $bestellingen = $bestellingSrv->getBestellingenByKlantId(
        (int) (unserialize($_SESSION["klant"])->getKlantid())
    );
} catch (GeenBestellingenException $e) {
    $error = "Je hebt geen bestellingen geplaatst.";
}



include("Presentation/bestellinglijstForm.php");