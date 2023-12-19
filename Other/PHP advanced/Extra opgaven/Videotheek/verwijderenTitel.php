<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;

$filmSvc = new FilmService();
$filmLijst = $filmSvc->getFilmsOverzicht();

if (isset($_GET["action"]) && ($_GET["action"] === "process")) 
{
    $filmSvc->deleteFilm((int)$_POST["selFilm"]);
        header("location: verwijderenTitel.php?action=verwijderd");
}

include("Presentation/verwijderenTitelForm.php");