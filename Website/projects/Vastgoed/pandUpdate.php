<?php

declare(strict_types=1);
require_once('data/autoloader.php');

include('data/sessionValidationScript.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$message = "";

if (isset($_GET["message"]) && $_GET["message"] == "updated") {
    $message = "Gerelateerde gegevens succesvol aangepast.";
}

$pandID = null;

if (isset($_GET["pandID"])) {
    $pandID = $_GET["pandID"];
    $pandDetails = getPandDetails($pandID);
} else {
    $pandID = null;
}

include("presentation/pandUpdatePresentation.php");
