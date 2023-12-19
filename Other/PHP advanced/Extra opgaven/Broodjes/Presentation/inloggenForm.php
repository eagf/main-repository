<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjes login</title>
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css" />
</head>

<body>

    <h1>Broodjes login</h1>
    <?php
    if ($error == "" && isset($_GET["action"]) && $_GET["action"] == "geregistreerd" && isset($_SESSION["wachtwoord"])) { ?>
        <span id='confirmed'>U bent succesvol geregistreerd.</span><br>
        <span>Uw wachtwoord is:
            <?php echo $_SESSION["wachtwoord"] ?>
        </span><br><br>
        <?php unset($_SESSION["wachtwoord"]);
    } elseif ($error == "" && isset($_GET["action"]) && $_GET["action"] == "geupdatet") { ?>
        <span id='confirmed'>Uw wachtwoord is geupdatet.</span><br><br>
        <span>Uw nieuwe wachtwoord is:
            <?php echo $_SESSION["wachtwoord"] ?>
        </span><br><br>
        <?php unset($_SESSION["wachtwoord"]);
    }
    if (isset($_GET["action"]) && ($_GET["action"] === "nieuwWachtwoord" || $_GET["action"] === "processNieuwWachtwoord")) { ?>
        <form action="inloggen.php?action=processNieuwWachtwoord" method="post">
            <label for="email">E-mailadres: </label>
            <input type="email" name="txtEmail"><br><br>
            <input type="submit" value="Nieuw wachtwoord aanvragen">
        </form>
        <?php
    } else { ?>
        <form action="inloggen.php?action=process" method="post">
            <label for="email">E-mailadres: </label>
            <input type="email" name="txtEmail"><br><br>

            <label for="wachtwoord">Wachtwoord: </label>
            <input type="password" name="txtWachtwoord">

            <button type="submit">Inloggen</button>
        </form>
    <?php }
    if ($error) {
        ?>
        <p id='error'>
            <?php echo $error; ?>
        </p>
        <?php
    }

    if (isset($_GET["action"]) && ($_GET["action"] === "nieuwWachtwoord" || $_GET["action"] === "processNieuwWachtwoord")) { ?>
        <br><a href="inloggen.php">Inloggen</a>
    <?php } else { ?>
        <p><a href="inloggen.php?action=nieuwWachtwoord">Wachtwoord vergeten?</a></p>
    <?php } ?>
    <p>Nog geen account? Klik <a href="registreren.php">hier</a> om je te registreren.</p>

</body>

</html>