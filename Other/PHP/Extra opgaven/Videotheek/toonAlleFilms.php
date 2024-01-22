<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;

$filmSvc = new FilmService();
$filmLijst = $filmSvc->getFilmsOverzicht();

include("Presentation/overzichtFilms.php");