<?php

declare(strict_types=1);
require_once('data/autoloader.php');

$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';

include("presentation/contactPresentation.php");

