<?php

declare(strict_types=1);

spl_autoload_register();

require_once("vendor/autoload.php");

session_start();

use Business\UserService;
use Exceptions\UserNotFoundException;
use Exceptions\InvalidPasswordException;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/Business/UserService.php";
require_once __DIR__ . "/Exceptions/UserNotFoundException.php";
require_once __DIR__ . "/Exceptions/InvalidPasswordException.php";
*/

$error = "";
if (isset($_GET["action"]) && ($_GET["action"]) === "process") {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $userService = new UserService();
    try {
        $userAccount = $userService->loginUser($username, $password);
        $_SESSION["userAccount"] = serialize($userAccount);
        $_SESSION["user"] = $username;
        header("location: filmoverzicht.php");
    } catch (UserNotFoundException $e) {
        $error = "Gebruiker kan niet gevonden worden in de database.";
    } catch (InvalidPasswordException $e) {
        $error = "Het passwoord is niet correct.";
    } catch (\Exception $e) {
        $error = "Onbekende fout: kan niet inloggen.";
    }
}

//$loader = new FilesystemLoader('Presentation');
//$twig = new Environment($loader);

//print $twig->render("login.twig", array("error" => $error));
include_once 'Presentation/login.php';
