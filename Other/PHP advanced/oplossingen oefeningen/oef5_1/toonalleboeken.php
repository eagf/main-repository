<?php
//toonalleboeken.php
declare(strict_types = 1);

require_once("bootstrap.php");

use Business\BoekService;

$boekSvc = new BoekService();
$boekenLijst = $boekSvc->getBoekenOverzicht();

print $twig->render("boekenlijst.twig", array("boekenlijst"=>$boekenLijst));

?>

