<?php

declare(strict_types=1);
require_once('data/autoloader.php');

require_once('data/DBConfig.php');
require_once('data/functions.php');

$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
$pandenOverzicht = getPandenOverzicht($statusFilter);

include("presentation/aanbodPresentation.php");

