<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$message = "";

if (isset($_POST["pandID"])) {
    deletePand((int) $_POST["pandID"]);
    $message = "Pand en gerelateerde gegevens succesvol verwijderd.";
}

include("presentation/pandDeletePresentation.php");
