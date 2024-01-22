<?php
//registratieGebruiker.php

declare(strict_types=1);
require_once("GebruikerBroodje.php");

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registreren gebruiker</title>
</head>

<body>
    <h1>Broodjesbar "Het Wondelgempje"</h1>
    <h2>Registreren</h2>
    <form action="inloggenGebruiker.php?nieuweGebruiker=1" method="post">
        Naam: <input type="text" name="naam"><br><br>
        E-mailadres: <input type="text" name="emailadresNieuw" ?
        <?php
            if(isset($_SESSION["emailadres"])){ 
                print(" value=" . $_SESSION["emailadres"]);
            }
        ?>
        ><br><br>
        Wachtwoord: <input type="password" name="wachtwoordNieuw"><br><br>
        Herhaling wachtwoord: <input type="password" name="wachtwoordNieuwControle">
        <input type="submit" value="OK"> <br>
        <?php
            if ($_SESSION["controleEmailadres"] === false) {
                print("<p style='color:red'>Dit e-mailadres is al in gebruik!</p>");
            }
            if ($_SESSION["controleWachtwoord"] === false) {
                print("<p style='color:red'>De wachtwoorden zijn niet gelijk!</p>");
            }
        ?>
    </form><br>
    <a href="overzichtBroodjes.php">Overzicht bestelde broodjes</a>
</body>

</html>