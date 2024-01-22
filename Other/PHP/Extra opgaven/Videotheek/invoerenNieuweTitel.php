<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;
use Exceptions\TitelBestaatException;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $filmSvc = new FilmService();
        $filmSvc->createFilm($_POST["txtTitel"]);
        header("location: invoerenNieuweTitel.php?action=toegevoegd");
        exit(0);
    } catch (TitelBestaatException $ex) {
        header("location: invoerenNieuweTitel.php?error=titelbestaat");
        exit(0);
    }
}

include("Presentation/nieuweTitelForm.php");

