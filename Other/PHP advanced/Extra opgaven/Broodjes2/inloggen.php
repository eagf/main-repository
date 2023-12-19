<?php
declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;

use Entities\Klant;

use Exceptions\KlantBestaatNietException;
use Exceptions\WachtwoordIncorrectException;

$error = "";

if (isset($_GET["action"]) && $_GET["action"] === "uitloggen" && isset($_SESSION["klant"])) {
    unset($_SESSION["klant"]);
    header("location: inloggen.php");
}

if (isset($_GET["action"]) && ($_GET["action"]) === "process") {
    $email = $_POST["email"];
    $wachtwoord = $_POST['wachtwoord'];

    $klantSrv = new KlantService();
    try {
        $klant = $klantSrv->login($email, $wachtwoord);
        $_SESSION["klant"] = serialize($klant);
        header("location: broodjeslijst.php");
    } catch (KlantBestaatNietException $e) {
        $error = "Gebruiker kan niet gevonden worden in de database.";
    } catch (WachtwoordIncorrectException $e) {
        $error = "Het passwoord is niet correct.";
    } catch (\Exception $e) {
        $error = "Onbekende fout: kan niet inloggen.";
    }
}

include ("Presentation/inloggenForm.php");
