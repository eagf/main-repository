<?php
declare(strict_types=1);

spl_autoload_register();

use Business\FilmService;
use Exceptions\ExemplaarDoesNotExistException;
use Exceptions\ExemplaarIsAlTerugGebracht;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $filmSvc = new FilmService();
        $exemplaar = $filmSvc->getExemplaarById((int) $_POST["nummer"]);
        $filmSvc->updateAanwezigheid($exemplaar->getId(), 1);
        header("location: terugbrengenFilm.php?action=teruggebracht");
    } catch (ExemplaarDoesNotExistException $ex) {
        header("location: terugbrengenFilm.php?error=nummerBestaatNiet");
    } catch (ExemplaarIsAlTerugGebracht $ex) {
        header("location: terugbrengenFilm.php?error=nummerIsAlTeruggebracht");
    }
}
include("Presentation/terugbrengenFilmForm.php");