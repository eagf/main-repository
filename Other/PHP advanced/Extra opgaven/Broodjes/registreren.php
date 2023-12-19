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
    if ($error == "") {
        try {
            $klantenSrv = new KlantService();
            $wachtwoord = $klantenSrv->willekeurigWachtwoord();
            $_SESSION["wachtwoord"] = $wachtwoord;
            $klantenSrv->registreer(
                $_POST["txtNaam"], 
                $_POST["txtVoornaam"],
                $_POST["txtEmail"],
                $wachtwoord);
            header("location: inloggen.php?action=geregistreerd");
        } catch (OngeldigEmailadresException $e) {
            $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
        } catch (KlantBestaatAlException $e) {
            $error = "Er bestaat al een klant met dit e-mailadres.<br>";
        }
    }
}

include("Presentation/registrerenForm.php");