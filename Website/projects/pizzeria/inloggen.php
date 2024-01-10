<?php

declare(strict_types=1);

require_once('Data/autoloader.php');
session_start();

$error = "";
$klantSrv = new KlantService();
$plaatsSrv = new PlaatsService();
$plaatsenLijst = $plaatsSrv->getAll();


if (isset($_SESSION["klant"]) && isset($_GET["action"]) && ($_GET["action"] === "uitloggen")) {
    unset($_SESSION["klant"]);
}

if (isset($_SESSION["klant"])) {
    $klant = unserialize($_SESSION["klant"]);
    $plaats = $plaatsSrv->getPlaatsByKlantId($klant->getKlantId());
}

//inloggen:

if (isset($_GET["action"]) && ($_GET["action"]) === "processInloggen") {
    $_SESSION["email"] = $_POST["txtEmail"];
    $email = $_POST["txtEmail"];
    $wachtwoord = $_POST["txtWachtwoord"];
    try {
        $klant = $klantSrv->login($email, $wachtwoord);
        $_SESSION["klantId"] = $klant->getKlantId();
        $_SESSION["naam"] = $klant->getKlantNaam();
        $_SESSION["voornaam"] = $klant->getKlantVoornaam();
        $_SESSION["straat"] = $klant->getKlantStraat();
        $_SESSION["huisnummer"] = $klant->getKlantHuisnummer();
        $_SESSION["postcode"] = $plaatsSrv->getPlaatsByKlantId($klant->getKlantId())->getPostcode();
        $_SESSION["telefoonnummer"] = $klant->getKlantTelefoonnummer();
        $_SESSION["email"] = $klant->getKlantEmail();
        $_SESSION["info"] = $klant->getKlantInfo();
        $_SESSION["klant"] = serialize($klant);
        header("location: afrekenen.php");
    } catch (OngeldigEmailadresException $e) {
        $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.";
    } catch (NietInDatabaseException $e) {
        $error = "Gebruiker kan niet gevonden worden in de database.";
    } catch (WachtwoordIncorrectException $e) {
        $error = "Het wachtwoord is niet correct.";
    } catch (\Exception $e) {
        $error = "Onbekende fout: kan niet inloggen.";
    }
}

//nieuw wachtwoord:

if (isset($_GET["action"]) && $_GET["action"] === "processNieuwWachtwoord") {

    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"];
        $_SESSION["email"] = $email;
    } else {
        $error = "Het e-mailadres moet ingevuld worden.<br>";
    }
    if ($error == "") {
        try {
            $wachtwoord = $_POST["txtWachtwoord"];
            $klantSrv->updateWachtwoord(
                $email,
                $wachtwoord
            );
            header("location: inloggen.php?page=inloggen&action=geupdatet");
        } catch (OngeldigEmailadresException $e) {
            $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
        } catch (NietInDatabaseException $e) {
            $error = "Gebruiker kan niet gevonden worden in de database.<br>";
        }
    }
}

//registreren:

if (isset($_GET["action"]) && ($_GET["action"] === "processRegistreren")) {
    if (isset($_POST["checkRegistreren"]) && $_POST["checkRegistreren"] === "on") {

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
                $klant = $klantSrv->registreer(
                    $_POST["txtNaam"],
                    $_POST["txtVoornaam"],
                    $_POST["txtStraat"],
                    $_POST["txtHuisnummer"],
                    $_POST["selPostcode"],
                    $_POST["txtTelefoonnummer"],
                    $_POST["txtEmail"],
                    $_POST["txtWachtwoord"],
                    $_POST["txtWachtwoordHerhaal"],
                    $_POST["txtInfo"]
                );
                $klantId = $klant->getKlantId();
                $_SESSION["klantId"] = $klantId;
                $_SESSION["naam"] = $_POST["txtNaam"];
                $_SESSION["voornaam"] = $_POST["txtVoornaam"];
                $_SESSION["straat"] = $_POST["txtStraat"];
                $_SESSION["huisnummer"] = $_POST["txtHuisnummer"];
                $_SESSION["postcode"] = $_POST["selPostcode"];
                $_SESSION["telefoonnummer"] = $_POST["txtTelefoonnummer"];
                $_SESSION["email"] = $_POST["txtEmail"];
                $_SESSION["info"] = $_POST["txtInfo"];
                $_SESSION["klant"] = serialize($klant);
                header("location: afrekenen.php?action=geregistreerd");
            } catch (OngeldigEmailadresException $e) {
                unset($_SESSION["email"]);
                $error = "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
            } catch (WachtwoordenKomenNietOvereenException $e) {
                $error = "De ingevulde wachtwoorden komen niet overeen.<br>";
            } catch (KlantBestaatAlException $e) {
                unset($_SESSION["email"]);
                $error = "Er bestaat al een klant met dit e-mailadres.<br>";
            } catch (NietInDatabaseException $e) {
                unset($_SESSION["postcode"]);
                $error = "De opgegeven postcode wordt niet teruggevonden.<br>";
            }
        }
    } else {
        try {
            $klant = $klantSrv->registreer(
                $_POST["txtNaam"],
                $_POST["txtVoornaam"],
                $_POST["txtStraat"],
                $_POST["txtHuisnummer"],
                $_POST["selPostcode"],
                $_POST["txtTelefoonnummer"],
                "0",
                "0",
                "0",
                $_POST["txtInfo"]
            );
            $klantId = $klant->getKlantId();
            $_SESSION["klantId"] = $klantId;
            $_SESSION["naam"] = $_POST["txtNaam"];
            $_SESSION["voornaam"] = $_POST["txtVoornaam"];
            $_SESSION["straat"] = $_POST["txtStraat"];
            $_SESSION["huisnummer"] = $_POST["txtHuisnummer"];
            $_SESSION["postcode"] = $_POST["selPostcode"];
            $_SESSION["telefoonnummer"] = $_POST["txtTelefoonnummer"];
            $_SESSION["email"] = $_POST["txtEmail"];
            $_SESSION["info"] = $_POST["txtInfo"];
            $_SESSION["klant"] = serialize($klant);
            header("location: afrekenen.php");
        } catch (NietInDatabaseException $e) {
            unset($_SESSION["postcode"]);
            $error = "De opgegeven postcode wordt niet teruggevonden.<br>";
        }
    }
}

// Gegevens updaten:

if (isset($_GET["action"]) && $_GET["action"] === "processGegevensUpdaten") {
    if (isset($_SESSION["klant"])) {
        try {
            $klant = $klantSrv->updateKlant(
                $_POST["txtNaam"],
                $_POST["txtVoornaam"],
                $_POST["txtStraat"],
                $_POST["txtHuisnummer"],
                $_POST["selPostcode"],
                $_POST["txtTelefoonnummer"],
                $_POST["txtInfo"],
                unserialize($_SESSION["klant"])->getKlantId()
            );
            $klantId = $klant->getKlantId();
            $_SESSION["klantId"] = $klantId;
            $_SESSION["naam"] = $_POST["txtNaam"];
            $_SESSION["voornaam"] = $_POST["txtVoornaam"];
            $_SESSION["straat"] = $_POST["txtStraat"];
            $_SESSION["huisnummer"] = $_POST["txtHuisnummer"];
            $_SESSION["postcode"] = $_POST["selPostcode"];
            $_SESSION["telefoonnummer"] = $_POST["txtTelefoonnummer"];
            $_SESSION["email"] = $_POST["txtEmail"];
            $_SESSION["info"] = $_POST["txtInfo"];
            $_SESSION["klant"] = serialize($klant);
            header("location: afrekenen.php?action=geupdatet");
        } catch (NietInDatabaseException $e) {
            unset($_SESSION["postcode"]);
            $error = "De opgegeven postcode wordt niet teruggevonden.<br>";
        }
    } else {
        header("location: inloggen.php");
    }
}

include("Presentation/inloggenPresentation.php");
