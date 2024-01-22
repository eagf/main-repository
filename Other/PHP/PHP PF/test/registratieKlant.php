<?php
//registratieKlant.php

declare(strict_types=1);
require_once("KlantenLijst.php");

session_start();
$_SESSION["controleKlant"] = true;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registreren klant</title>
</head>

<body>
    <h2>Registreren</h2>
    <form action="gegevensOpvragen.php?nieuweKlant=1" method="post">
        Voornaam: <input type="text" name="voornaamNieuw" required><br><br>
        Achternaam: <input type="text" name="achternaamNieuw" required><br><br>
        E-mailadres: <input type="text" name="emailNieuw" required><br><br>
        <input type="submit" value="Registreer"> <br>
        <?php
        if (isset($_SESSION["controleEmail"]) && $_SESSION["controleEmail"] == false) { ?>
            <p style='color:red'>Dit e-mailadres is al in gebruik!</p>
        <?php } ?>
    </form><br>
    <a href="bestelOverzicht.php">Besteloverzicht</a>
</body>

</html>