<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;
use Exceptions\ExemplaarDoesNotExistException;
use Exceptions\ExemplaarIsAlVerhuurd;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $filmSvc = new FilmService();
        $exemplaar = $filmSvc->getExemplaarById((int) $_POST["nummer"]);
        $filmSvc->updateAanwezigheid($exemplaar->getId(), 0);
        header("location: hurenFilm.php?action=verhuurd");
    } catch (ExemplaarDoesNotExistException $ex) {
        header("location: hurenFilm.php?error=nummerBestaatNiet");
    } catch (ExemplaarIsAlVerhuurd $ex) {
        header("location: hurenFilm.php?error=nummerIsAlVerhuurd");
    }
}
include("Presentation/hurenFilmForm.php");