<?php

declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;
use Exceptions\NummerBestaatException;
use Exceptions\ExemplaarDoesNotExistException;

$filmSvc = new FilmService();
$filmLijst = $filmSvc->getFilmsOverzicht();

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $filmSvc->createExemplaar((int)$_POST["selFilm"], (int)$_POST["exemplaarNummer"]);
        header("location: invoerenNieuwExemplaar.php?action=toegevoegd");
    } catch (NummerBestaatException $ex) {
        header("location: invoerenNieuwExemplaar.php?error=nummerbestaat");
    } 
}

include("Presentation/nieuwExemplaarForm.php");