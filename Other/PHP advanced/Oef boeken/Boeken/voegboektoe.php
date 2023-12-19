<?php
//voegboektoe.php 
declare(strict_types=1);

spl_autoload_register();

use Business\GenreService;
use Business\BoekService;
use Exceptions\TitelBestaatException;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $boekSvc = new BoekService();
        $boekSvc->voegNieuwBoekToe($_POST["txtTitel"], (int)$_POST["selGenre"]);
        header("location: toonalleboeken.php");
        exit(0);
    } catch (TitelBestaatException $ex) {
        header("location: voegboektoe.php?error=titelbestaat");
        exit(0);
    }
} else {
    $genreSvc = new GenreService();
    $genreLijst = $genreSvc->getGenresOverzicht();

    if (isset($_GET["error"])) {
        $error = $_GET["error"];
    }
    include("Presentation/nieuwboekForm.php");
}
