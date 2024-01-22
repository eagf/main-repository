<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;

$filmSvc = new FilmService();
$exemplarenLijst = $filmSvc->getExemplarenOverzicht();

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    $filmSvc->deleteExemplaar((int) $_POST["selExemplaar"]);
    header("location: verwijderenExemplaar.php?action=verwijderd");
}

include("Presentation/verwijderenExemplaarForm.php");