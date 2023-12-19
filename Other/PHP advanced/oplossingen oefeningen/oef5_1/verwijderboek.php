<?php
//verwijderboek.php

declare(strict_types = 1);

require_once("bootstrap.php");

use Business\BoekService;

$boekSvc = new BoekService();
$boekSvc->verwijderBoek((int)$_GET["id"]);
header("location: toonalleboeken.php");
exit(0);


