<?php
//bestellenBroodjes.php

declare(strict_types=1);
require_once("GebruikerBroodje.php");

session_start();

$gebruikerClass = new GebruikersLijst();

if (isset($_POST["emailadres"])) {
    $_SESSION["emailadres"] = $_POST["emailadres"];
    $controleGebruiker = $gebruikerClass->controleGebruiker($_POST["emailadres"], $_POST["wachtwoord"]);
    if ($controleGebruiker == false) {
        $_SESSION["controleGebruiker"] = false;
        header('Location: inloggenGebruiker.php');
    }
    else {
        $_SESSION["controleEmailadres"] = true;
    }
    $controleGeblokeerd = $gebruikerClass->getGeblokkeerd($_POST["emailadres"]);
    if ($controleGeblokeerd === 1) {
        $_SESSION["controleGeblokkeerd"] = false;
        header('Location: inloggenGebruiker.php');
    }
    else {
        $_SESSION["controleGeblokkeerd"] = true;
    }
}

$broodjeClass = new BroodjesLijst();
$broodjes = $broodjeClass->getBroodjesLijst();

if (isset($_GET["besteld"]) && $_GET["besteld"] == true) {
    $broodjeClass->toevoegenBroodje((int) $gebruikerClass->getIDGebruiker((string)$_SESSION["emailadres"]), (int)$_GET["broodje"]);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bestellen broodjes</title>
</head>

<body>
    <h1>Broodjesbar "Het Wondelgempje"</h1>
    <h2>Broodjes bestellen</h2>
    
    <table>
        <tr>
            <th>Naam</th>
            <th>Omschrijving</th>
            <th>Prijs</th>
            <th>Bestel</th>
        </tr>
        <?php
            foreach ($broodjes as $broodje) {
                print("<tr>
                <td>".$broodje->getNaam()."</td>
                <td>".$broodje->getOmschrijving()."</td>
                <td>€".number_format($broodje->getPrijs(), 2)."</td>");
                if (!isset($_GET["besteld"])) {
                    print("<td><a href='bestellenBroodjes.php?besteld=true&broodje=".
                    $broodje->getID()."'>Bestel</a></td>");
                }
                print("</tr>");
            }
        ?> 
    </table>
    
    <?php
        if (isset($_GET["besteld"]) && $_GET["besteld"] == true) {
            print("<h3>Uw broodje is besteld!</h3>");
        }
    ?><br><br>
    <a href="overzichtBroodjes.php">Overzicht bestelde broodjes</a>
</body>

</html>