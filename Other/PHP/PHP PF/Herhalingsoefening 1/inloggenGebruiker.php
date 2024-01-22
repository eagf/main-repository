<?php
//inloggenGebruiker.php

declare(strict_types=1);
require_once("GebruikerBroodje.php");

session_start();

$gebruiker = new GebruikersLijst();
// Controles bij nieuwe registratie:
if (isset($_GET["nieuweGebruiker"]) && (int)$_GET["nieuweGebruiker"] === 1) {
    $controle = true;
    // Controle e-mailadres in database:
    if (!$gebruiker->controleEmailadres($_POST["emailadresNieuw"])) {
        $_SESSION["controleEmailadres"] = true;
    }
    else {
        $_SESSION["controleEmailadres"] = false;
        $controle = false;
        header('Location: registratieGebruiker.php');
    }
    
    // Controle dubbele wachtwoorden identiek:
    if ($_POST["wachtwoordNieuw"] === $_POST["wachtwoordNieuwControle"]) {
        $_SESSION["controleWachtwoord"] = true;
    }
    else {
        $_SESSION["controleWachtwoord"] = false;
        $controle = false;
        header('Location: registratieGebruiker.php');
    }
    if ($controle == true) {
        $gebruiker->nieuweGebruiker($_POST["naam"], $_POST["emailadresNieuw"], $_POST["wachtwoordNieuw"]);
    } 
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inloggen gebruiker</title>
</head>

<body>
    <h1>Broodjesbar "Het Wondelgempje"</h1>
    <h2>Inloggen</h2>
    <form action="bestellenBroodjes.php" method="post">
        E-mailadres: <input type="text" name="emailadres"
            <?php
                if(isset($_SESSION["emailadres"])){ 
                    print(" value=" . $_SESSION["emailadres"]);
                }
            ?>
        ><br><br>
        Wachtwoord: <input type="password" name="wachtwoord">
        <input type="submit" value="OK">
    </form>
    <?php
    if (isset($_SESSION["controleGebruiker"]) && $_SESSION["controleGebruiker"] == false) {
        print("<p style='color:red'>Je wachtwoord en/of gebruikernaam kloppen niet.</p>
        <p>Klik <a href='registratieGebruiker.php'>hier</a> om je te registeren.");
        unset($_SESSION["controleGebruiker"]);
    }
    elseif (isset($_SESSION["controleGeblokkeerd"]) && $_SESSION["controleGeblokkeerd"] == false) {
        print("<p style='color:red'>Deze gebruiker is geblokkeerd!</p>");
        unset($_SESSION["controleGeblokkeerd"]);
    }
    elseif (isset($_POST["emailadresNieuw"])) {
        print("<p>Je bent succesvol geregistreerd! Je kan nu inloggen om te kunnen bestellen.</p>");
    }
    else {
        print("<p>Nog geen gebruiker? Klik dan
        <a href='registratieGebruiker.php'> hier</a> om je te registeren.</p>");
        unset($_POST["emailadresNieuw"]);
    }


    ?><br><br>
    <a href="overzichtBroodjes.php">Overzicht bestelde broodjes</a>
</body>

</html>