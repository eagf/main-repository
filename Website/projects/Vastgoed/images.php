<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$message = "";

if (isset($_GET["message"])) {

    if ($_GET["message"] == "added") {
        $message = "Nieuwe afbeeldingen succesvol toegevoegd.";
    }
    if ($_GET["message"] == "removed") {
        $message = "Afbeeldingen succesvol verwijderd.";
    }
}

$pandID = null;

if (isset($_GET["pandID"])) {
    $pandID = $_GET["pandID"];
} else {
    $pandID = null;
}

include("presentation/imagesPresentation.php");
