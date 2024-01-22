<?php
declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\KlantService;

use Entities\Klant;

use Exceptions\KlantBestaatNietException;
use Exceptions\WachtwoordIncorrectException;
use Exceptions\OngeldigEmailadresException;

$error = "";

if (isset($_GET["action"]) && $_GET["action"] === "uitloggen" && isset($_SESSION["klant"])) {
    unset($_SESSION["klant"]);
    header("location: inloggen.php");
}

if (isset($_GET["action"]) && ($_GET["action"]) === "process") {
    $email = $_POST["txtEmail"];
    $wachtwoord = $_POST["txtWachtwoord"];
    $klantSrv = new KlantService();
    try {
        $klant = $klantSrv->login($email, $wachtwoord);
        $_SESSION["klant"] = serialize($klant);
        header("location: broodjeslijst.php");
    } catch (OngeldigEmailadresException $e) {
        $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
    } catch (KlantBestaatNietException $e) {
        $error = "Gebruiker kan niet gevonden worden in de database.";
    } catch (WachtwoordIncorrectException $e) {
        $error = "Het wachtwoord is niet correct.";
    } catch (\Exception $e) {
        $error = "Onbekende fout: kan niet inloggen.";
    }
}

if (isset($_GET["action"]) && $_GET["action"] === "processNieuwWachtwoord") {
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
            $klantenSrv->updateWachtwoord(
                $email,
                $wachtwoord
            );
            header("location: inloggen.php?action=geupdatet");
        } catch (OngeldigEmailadresException $e) {
            $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
        } catch (KlantBestaatNietException $e) {
            $error = "Gebruiker kan niet gevonden worden in de database.<br>";
        }
    }
}

include("Presentation/inloggenForm.php");