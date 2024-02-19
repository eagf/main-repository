<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

// Get the panddetails

$pandID = isset($_GET['pandID']) ? $_GET['pandID'] : null;
$pandDetails = getPandDetails($pandID);

// Set the google maps link

$straat = urlencode($pandDetails['straat']);
$nr = urlencode($pandDetails['nr']);
$bus = urlencode($pandDetails['bus']);
$postcode = urlencode($pandDetails['postcode']);
$gemeente = urlencode($pandDetails['gemeente']);

$addressQuery = "{$straat} {$nr} {$bus}, {$postcode} {$gemeente}";

$googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$addressQuery}";



include("presentation/detailPresentation.php");

