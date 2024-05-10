<?php

declare(strict_types=1);
require_once('data/autoloader.php');

include('data/sessionValidationScript.php');

$message = "";

if (isset($_GET["message"]) && $_GET["message"] == "added") {
    $message = "Nieuw pand en gerelateerde gegevens succesvol toegevoegd.";
}

include("presentation/pandInputPresentation.php");
