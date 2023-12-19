<?php
//aanmelden.php
declare(strict_types=1);

session_start();

// om te testen
unset($_SESSION["aangemeld"]);

require_once("business/UserService.php");

if (isset($_GET["action"]) && ($_GET["action"] === "login")) {
    $svc = new UserService();
    $toegelaten = $svc->controleerGebruiker(
            $_POST["txtGebruikersnaam"], $_POST["txtWachtwoord"]);
    
    if ($toegelaten) {
        $_SESSION["aangemeld"] = true;
        header("location: toongeheim.php");
        exit(0);
        
    } else {
        header("location: aanmelden.php");
        exit(0);
    }
    
} else {
    include("presentation/loginform.php");
}
