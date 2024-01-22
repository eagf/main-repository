<?php
session_start(); 
require_once("user.php");
$error = "";
if (isset($_POST["btnLogin"])) {
    $email = "";
    $wachtwoord = "";
    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"];
    } else {
        $error .= "Het e-mailadres moet ingevuld worden.<br>";
    }
    if (!empty($_POST["txtWachtwoord"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
    } else {
        $error .= "Het wachtwoord moet ingevuld worden.<br>";
    }
    if ($error == "") {
        try {
            $gebruiker = new User(null, $email, $wachtwoord);
            $gebruiker = $gebruiker->login();
            $_SESSION["gebruiker"] = serialize($gebruiker);
        } catch (WachtwoordIncorrectException $e) {
            $error .= "Het wachtwoord is niet correct.<br>";
        } catch (GebruikerBestaatNietException $e) {
            $error .= "Er bestaat geen gebruiker met dit e-mailadres.<br>";
        }
    }
} ?>

<?php
require_once("header.php");
?>

<h1>Login</h1>
<?php
if ($error == "" && isset($_SESSION["gebruiker"])) {
    echo "U bent succesvol ingelogd.";
} else if ($error != "") {
    echo "<span style=\"color:red;\">" . $error . "</span>";
}
if (!isset($_SESSION["gebruiker"])) {
?>
    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="POST">
        E-mailadres: <input type="email" name="txtEmail"><br>
        Wachtwoord: <input type="password" name="txtWachtwoord"><br>
        <input type="submit" value="Inloggen" name="btnLogin">
    </form>
<?php
}
?>



<?php
require_once("footer.php");
?>