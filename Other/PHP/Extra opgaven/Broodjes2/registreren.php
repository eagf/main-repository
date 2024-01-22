<?php
declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;

use Entities\Klant;

use Exceptions\KlantBestaatAlException;
use Exceptions\OngeldigEmailadresException;
use Exceptions\WachtwoordenKomenNietOvereenException;

$error = "";
if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    $email = "";
    $wachtwoord = "";
    $wachtwoordHerhaal = "";
    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"];
    } else {
        $error = "Het e-mailadres moet ingevuld worden.<br>";
    }
    if (!empty($_POST["txtWachtwoord"]) && !empty($_POST["txtWachtwoordHerhaal"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
    } else {
        $error = "Beide wachtwoordvelden moeten ingevuld worden.<br>";
    }
    if ($error == "") {
        try {
            $klantenSrv = new KlantService();
            $klantenSrv->registreer(
                $_POST["txtNaam"], 
                $_POST["txtVoornaam"],
                $_POST["txtEmail"],
                $_POST["txtWachtwoord"],
                $_POST["txtWachtwoordHerhaal"]);
            header("location: registreren.php?action=geregistreerd");
        } catch (OngeldigEmailadresException $e) {
            $error .= "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
        } catch (WachtwoordenKomenNietOvereenException $e) {
            $error .= "De ingevulde wachtwoorden komen niet overeen.<br>";
        } catch (KlantBestaatAlException $e) {
            $error .= "Er bestaat al een klant met dit e-mailadres.<br>";
        }
    }
}

include("Presentation/registrerenForm.php");