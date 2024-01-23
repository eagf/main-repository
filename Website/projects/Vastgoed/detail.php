<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$pandID = isset($_GET['pandID']) ? $_GET['pandID'] : null;
$pandDetails = getPandDetails($pandID);

include("presentation/detailPresentation.php");
