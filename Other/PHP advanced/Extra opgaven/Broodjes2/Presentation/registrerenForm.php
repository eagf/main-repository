<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>

<body>

    <h1>Broodjes registreren</h1>

    <?php
    if ($error == "" && isset($_GET["action"]) && $_GET["action"] == "geregistreerd") {
        echo "<span style='color:green;'>U bent succesvol geregistreerd.</span><br>";
    } else if ($error != "") {
        echo "<span style='color:red;'>" . $error . "</span><br>";
    }
    ?>
    <form action="registreren.php?action=process" method="post">
        Naam: <input type="naam" name="txtNaam"><br><br>
        Voornaam: <input type="voornaam" name="txtVoornaam"><br><br>
        E-mailadres: <input type="email" name="txtEmail"><br><br>
        Wachtwoord: <input type="password" name="txtWachtwoord"><br><br>
        Herhaal wachtwoord: <input type="password" name="txtWachtwoordHerhaal"><br><br>
        <input type="submit" value="Registreren">
    </form>
    <p>Klik <a href="inloggen.php">hier</a> om je in te loggen.</p>
</body>

</html>