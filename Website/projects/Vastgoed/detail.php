<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');


// Get the panddetails

$pandID = isset($_GET['pandID']) ? $_GET['pandID'] : null;
$pandDetails = getPandDetails($pandID);

$afbeeldingenURLs = explode('|', $pandDetails['afbeeldingen']);
$beschrijvingen = explode('|', $pandDetails['beschrijvingen']);
$totalImages = count($afbeeldingenURLs);

// Set the google maps link

$straat = urlencode($pandDetails['straat']);
$nr = urlencode($pandDetails['nr']);
$bus = urlencode($pandDetails['bus']);
$postcode = urlencode($pandDetails['postcode']);
$gemeente = urlencode($pandDetails['gemeente']);

$addressQuery = "{$straat} {$nr} {$bus}, {$postcode} {$gemeente}";

$googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$addressQuery}";


// EPC arrow

$epcIndex = isset($pandDetails['epcIndex']) && is_numeric($pandDetails['epcIndex']) ? (float)$pandDetails['epcIndex'] : 0;

if ($epcIndex >= 500) {
    $translatePercentage = 0;
} elseif ($epcIndex <= 0) {
    $translatePercentage = 90;
} else {
    $translatePercentage = ((1 - ($epcIndex / 500)) * 100) - 4;
}

// EPC block

function mapEpcIndexToImageIndex($epcIndex) {
    if ($epcIndex <= 0) return 6; // A+
    if ($epcIndex <= 100) return 5; // A
    if ($epcIndex <= 200) return 4; // B
    if ($epcIndex <= 300) return 3; // C
    if ($epcIndex <= 400) return 2; // D
    if ($epcIndex <= 500) return 1; // E
    return 0; // F
}

$imageIndex = mapEpcIndexToImageIndex($pandDetails['epcIndex'] ?? 0);

include("presentation/detailPresentation.php");

