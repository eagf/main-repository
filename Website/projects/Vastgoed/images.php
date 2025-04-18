<?php

declare(strict_types=1);
require_once('data/autoloader.php');

include('data/sessionValidationScript.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$message = "";

if (isset($_GET["message"])) {
    if ($_GET["message"] == "added") {
        $message = "Nieuwe afbeeldingen succesvol toegevoegd.";
    } elseif ($_GET["message"] == "removed") {
        $message = "Afbeeldingen succesvol verwijderd.";
    } elseif ($_GET["message"] == "updated") {
        $message = "Beschrijvingen succesvol aangepast.";
    } elseif ($_GET["message"] == "order_updated") {
        $message = "Volgorde succesvol aangepast.";
    }
}

$pandID = null;

if (isset($_GET["pandID"])) {
    $pandID = $_GET["pandID"];
} else {
    $pandID = null;
}

include("presentation/pandImagesPresentation.php");
