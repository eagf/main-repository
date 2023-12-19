<?php
//aanwezighedendoorgeven.php 

declare(strict_types=1);

require_once("business/Klasbeheer.php");

$klas = new Klasbeheer();
$resultaat = $klas->registreerAanwezigheden($_POST["aanwezig"]);
include("presentation/aanwezigendoorgegeven.php");

