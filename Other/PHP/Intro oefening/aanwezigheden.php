<?php
//aanwezigheden.php 

declare(strict_types=1);

require_once("business/Klasbeheer.php");

$klas = new Klasbeheer();
$aanwezigheden = $klas->aanwezigheidslijst();
include("presentation/aanwezigheidslijst.php");
