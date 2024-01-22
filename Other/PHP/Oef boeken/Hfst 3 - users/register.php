<?php
session_start();
require_once("user.php");

$error = "";
if (isset($_POST["btnRegistreer"])) {
    $email = "";
    $wachtwoord = "";
    $wachtwoordHerhaal = "";
    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"];
    } else {
        $error .= "Het e-mailadres moet ingevuld worden.<br>";
    }
    if (!empty($_POST["txtWachtwoord"]) && !empty($_POST["txtWachtwoordHerhaal"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
    } else {
        $error .= "Beide wachtwoordvelden moeten ingevuld worden.<br>";
    }
    if ($error == "") {
        try {
            $gebruiker = new User();
            $gebruiker->setEmail($email);
            $gebruiker->setWachtwoord($wachtwoord, $wachtwoordHerhaal);
            $gebruiker = $gebruiker->register();
            $_SESSION["gebruiker"] = serialize($gebruiker);
        } catch (OngeldigEmailadresException $e) {
            $error .= "Het ingevulde e-mailadres is geen geldig e- mailadres.<br>";
        } catch (WachtwoordenKomenNietOvereenException $e) {
            $error .= "De ingevulde wachtwoorden komen niet overeen.<br>";
        } catch (GebruikerBestaatAlException $e) {
            $error .= "Er bestaat al een gebruiker met dit e-mailadres.<br>";
        }
    }
} // einde van de pagina-specifieke logica 
?>

<?php // start van de HTML 
require_once("header.php");
?>

<h1>Registreren</h1>

<?php
if ($error == "" && isset($_SESSION["gebruiker"])) {
    echo "U bent succesvol geregistreerd.";
} else if ($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}
if (!isset($_SESSION["gebruiker"])) {
?>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        E-mailadres: <input type="email" name="txtEmail"><br>
        Wachtwoord: <input type="password" name="txtWachtwoord"><br>
        Herhaal wachtwoord: <input type="password" name="txtWachtwoordHerhaal"><br>
        <input type="submit" value="Inloggen" name="btnRegistreer">
    </form>

<?php
} // einde van de HTML 
require_once("footer.php");
?>