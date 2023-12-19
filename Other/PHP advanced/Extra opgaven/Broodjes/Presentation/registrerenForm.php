<?php
declare(strict_types=1);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css"/>
</head>

<body>
    <h1>Broodjes registreren</h1>
    <?php
    if ($error != "") {
        echo "<span id='error'>" . $error . "</span><br>";
    }
    ?>
    <form action="registreren.php?action=process" method="post">
        Naam: <input type="naam" name="txtNaam"><br><br>
        Voornaam: <input type="voornaam" name="txtVoornaam"><br><br>
        E-mailadres: <input type="email" name="txtEmail"><br><br>
        <input type="submit" value="Registreren">
    </form>
    <p>Klik <a href="inloggen.php">hier</a> om je in te loggen.</p>
</body>

</html>