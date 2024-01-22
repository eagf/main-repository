<?php
//overzichtBroodjes.php

declare(strict_types=1);
require_once("GebruikerBroodje.php");

$gebruikerClass = new GebruikersLijst();
$broodjeClass = new BroodjesLijst();
$broodjes = $broodjeClass->getBroodjesLijst();
$besteldeBroodjes = $broodjeClass->getBesteldeBroodjesLijst();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Inloggen gebruiker</title>
</head>

<body>
    <h1>Broodjesbar "Het Wondelgempje"</h1>
    <h2>Overzicht bestelde broodjes: </h2>
    <table>
        <tr>
            <th>Bestelnummer</th>
            <th>Gebruiker</th>
            <th>Broodje</th>
        </tr>
        <?php
            foreach ($besteldeBroodjes as $broodje) {
                print("<tr>
                <td>".$broodje->getID()."</td>
                <td>". $gebruikerClass->getNaamGebruiker((int)$broodje->getGebruikersID())."</td>
                <td>". $broodjeClass->getBroodjeNaam((int)$broodje->getBroodjesID())."</td></tr>");
            }
        ?> 
    </table>
    <br>
    <h2>Totaal aantal broodjes:</h2>
    <table>
        <tr>
            <th>Broodje</th>
            <th>Aantal</th>
        </tr>
        <?php
            foreach ($broodjes as $broodje) {
                print("<tr>
                <td>".$broodje->getNaam()."</td>
                <td>". $broodjeClass->getAantalBroodjes((int)$broodje->getID())."</td></tr>");
            }
        ?> 
    </table>

</body>

</html>