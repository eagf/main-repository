<?php
//toongeheim.php
declare(strict_types=1);

session_start();

if (!isset($_SESSION["aangemeld"]) || ($_SESSION["aangemeld"] !== true) ) {
	header("location: aanmelden.php");
	exit(0);
}
include("presentation/geheimeinformatie.php");
