<?php

declare(strict_types=1);

spl_autoload_register();

session_start();

require_once("vendor/autoload.php");

use Business\ExemplaarService;
use Business\FilmService;
use Exceptions\FilmExistsException;
use Entities\FilmItem;
use Exceptions\FilmDoesNotExistException;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/Business/ExemplaarService.php";
require_once __DIR__ . "/Business/FilmService.php";
require_once __DIR__ . "/Exceptions/FilmExistsException.php";
require_once __DIR__ . "/Entities/FilmItem.php";
require_once __DIR__ . "/Exceptions/FilmDoesNotExistException.php";
require_once __DIR__ . "/Exceptions/ExemplaarDoesNotExistException.php";
*/

if (!isset($_SESSION["userAccount"])) {
    header("location: login.php");
    exit(0);
}

$filmService = new FilmService();
$exemplaarService = new ExemplaarService();
$error = "";
$zoekExemplaar = false;

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "addfilm":
            if (isset($_POST["title"]) && $_POST["title"] != "") {
                try {
                    $filmService->createFilm($_POST["title"]);
                } catch (FilmExistsException $e) {
                    $error = "Deze film bestaat al";
                }
            } else {
                $error = "Gelieve een title in te vullen.";
            }
            break;
        case "addExemplaar":
            if (isset($_POST["filmId"]) && $_POST["filmId"] != "") {
                try {
                    $exemplaarService->createExemplaar((int)$_POST["filmId"]);
                } catch (FilmDoesNotExistException $e) {
                    $error = "Deze film bestaat niet";
                }
            } else {
                $error = "Gelieve een film te selecteren.";
            }
            break;
        case "deleteFilm":
            if (isset($_POST["filmId"]) && $_POST["filmId"] != "") {
                try {
                    $filmService->deleteFilm((int)$_POST["filmId"]);
                } catch (\Exception $e) {
                    $error = "Film verwijderen is niet gelukt.";
                }
            } else {
                $error = "Gelieve een film te selecteren.";
            }
            break;
        case "deleteExemplaar":
            if (isset($_POST["exemplaarId"]) && $_POST["exemplaarId"] != "") {
                try {
                    $exemplaarService->deleteExemplaar((int)$_POST["exemplaarId"]);
                } catch (\Exception $e) {
                    $error = "Exemplaar verwijderen is niet gelukt.";
                }
            } else {
                $error = "Gelieve een exemplaar te selecteren.";
            }
            break;
        case "rentFilm":
            if (isset($_POST["exemplaarId"]) && $_POST["exemplaarId"] != "") {
                try {
                    $exemplaarService->setExemplaarAvailable((int)$_POST["exemplaarId"], false);
                } catch (\Exceptions\ExemplaarIsUnavailableException $e) {
                    $error = "Exemplaar is reeds gehuurd.";
                } catch (\Exceptions\ExemplaarDoesNotExistException $e) {
                    $error = "Exemplaar bestaat niet.";
                } catch (\Exception $e) {
                    $error = "Exemplaar huren is niet gelukt.";
                }
            } else {
                $error = "Gelieve een exemplaar te selecteren.";
            }
            break;
        case "returnFilm":
            if (isset($_POST["exemplaarId"]) && $_POST["exemplaarId"] != "") {
                try {
                    $exemplaarService->setExemplaarAvailable((int)$_POST["exemplaarId"], true);
                } catch (\Exception $e) {
                    $error = "Kan het exemplaar niet beschikbaar maken.";
                }
            } else {
                $error = "Gelieve een exemplaar te selecteren.";
            }
            break;
        case "zoekExemplaar":
            if (isset($_POST["exemplaarId"]) && $_POST["exemplaarId"] != "") {
                try {
                    $films = $filmService->getFilmByExId((int)$_POST["exemplaarId"], true);
					$zoekExemplaar = true;
				} catch (\Exception $e) {
                    $error = "Exemplaar werd niet gevonden.";
                }
            } else {
                $error = "Gelieve een exemplaar te selecteren.";
            }
            break;
   		
    }
}

if ($zoekExemplaar === false){
  $films = $filmService->getAllFilms();	
}
$filmItems = array();

foreach ($films as $film) {
    $exemplaren = $exemplaarService->getAllExemplarenByFilmId($film->getFilmId());
    $filmItem = new FilmItem($film, $exemplaren);
    array_push($filmItems, $filmItem);
}

//$loader = new FilesystemLoader('Presentation');
//$twig = new Environment($loader);

$account = unserialize($_SESSION["userAccount"]);
//$accountUser = $account->getUsername();


//print $twig->render("filmoverzicht.twig", array("filmItems" => $filmItems, "error" => $error, "username" => $account->getUsername()));

include_once 'Presentation/filmoverzicht.php';

