<?php

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\ProductService;
use Business\KlantService;
use Business\PlaatsService;

$error = "";
$productSrv = new ProductService();
$klantSrv = new KlantService();
$plaatsSrv = new PlaatsService();
$productLijst = $productSrv->getAll();

if (isset($_SESSION["klant"])) {
    $klant = unserialize($_SESSION["klant"]);
    $klantPromo = $klant->getKlantPromo();
    $plaats = $plaatsSrv->getPlaatsByKlantId($klant->getKlantId());
    $leverbaar = $plaats->getIsLeverbaar();
} 

if (isset($_SESSION["klant"]) && isset($_GET["action"]) && $_GET["action"] === "toggleKlantPromo") {
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
    header("location: overzicht.php");
}

if (isset($_SESSION["klant"]) && isset($_GET["action"]) && ($_GET["action"] === "uitloggen")) {
    unset($_SESSION["klant"]);
}

if (!isset($_SESSION["winkelmand"]) || (isset($_GET["action"]) && $_GET["action"] === "leegmaken")) {
    $_SESSION["winkelmand"] = serialize(array());
    header("location: overzicht.php#winkelmand");
}

$winkelmandLijst = unserialize($_SESSION["winkelmand"]);

if (isset($_GET["action"]) && ($_GET["action"] === "add") && isset($_GET["productId"])) {
    $productId = (int) $_GET["productId"];
    $product = $productSrv->getProductByProductId($productId);

    $index = $productSrv->getIndexWinkelmandLijstByProductId($winkelmandLijst, $productId);

    if ($index === null) {
        $productNieuw = array("productId" => $productId, "aantal" => (int) 1);
        array_push($winkelmandLijst, $productNieuw);
    } else {
        $winkelmandLijst[$index]["aantal"] += (int) 1;
    }
    $_SESSION["winkelmand"] = serialize($winkelmandLijst);
    header("location: overzicht.php#winkelmand");
} elseif (isset($_GET["action"]) && ($_GET["action"] === "remove") && isset($_GET["productId"])) {
    $productId = (int) $_GET["productId"];
    $product = $productSrv->getProductByProductId($productId);

    $index = $productSrv->getIndexWinkelmandLijstByProductId($winkelmandLijst, $productId);

    if ($winkelmandLijst[$index]["aantal"] === (int) 1) {
        unset($winkelmandLijst[$index]);
        $winkelmandLijst = array_values($winkelmandLijst);
    } else {
        $winkelmandLijst[$index]["aantal"] -= (int) 1;
    }
    $_SESSION["winkelmand"] = serialize($winkelmandLijst);
    header("location: overzicht.php#winkelmand");
}

if (isset($_GET["action"]) && ($_GET["action"] === "afrekenen")) {
    if (empty($winkelmandLijst)) {
        header("location: overzicht.php");
    }
    if (isset($_SESSION["klant"])) {
        header("location: afrekenen.php");
    } else {
        header("location: inloggen.php");
    }
};



include("Presentation/overzichtPresentation.php");
