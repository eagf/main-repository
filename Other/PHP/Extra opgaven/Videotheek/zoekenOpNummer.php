<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;
use Exceptions\ExemplaarDoesNotExistException;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    $filmSvc = new FilmService();
    try {
		$filmLijst = $filmSvc->getFilmsOverzicht();
        $exemplaar = $filmSvc->getExemplaarById((int) $_POST["nummer"]);
    } catch (ExemplaarDoesNotExistException $ex) {
        header("location: zoekenOpNummer.php?error=nummerBestaatNiet");
    } 
}

include("Presentation/zoekenOpNummerForm.php");