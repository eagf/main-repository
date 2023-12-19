<?php
//toonalleboeken.php 
declare(strict_types=1);

spl_autoload_register();

use Business\BoekService;

$boekSvc = new BoekService();
$boekenLijst = $boekSvc->getBoekenOverzicht();
include("Presentation/boekenlijst.php");