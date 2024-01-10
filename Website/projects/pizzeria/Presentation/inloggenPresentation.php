<?php

declare(strict_types=1);
require_once('Data/autoloader.php');
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Inloggen</title>
    <link rel="icon" type="image/x-icon" href="Presentation/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css" />
    <script>
        function toonVerborgenInputs() {
            var checkBox = document.getElementById("checkRegistreren");
            var input = document.getElementById("verborgen");
            if (checkBox.checked == true) {
                input.style.display = "block";
            } else {
                input.style.display = "none";
            }
        }
    </script>
</head>

<body>

    <div class="header">

        <a href="overzicht.php" class="logoHeader">Pizzeria: 'Paperella di Gomma'</a>
        <div class="header-right">
            <a href="overzicht.php">Overzicht</a>
            <a class="active" href="afrekenen.php">Afrekenen</a>
            <a href="info.php">Info</a>
        </div>

    </div>

    <div class="body-underheader">


        <!-- Nog niets geselecteerd -->

        <?php if (!isset($_GET["page"])) { ?>
            <h2 class="title-box">Inloggen/registreren</h2>
            <a class="button" href="inloggen.php?page=inloggen">Ik heb een account</a><br>
            <a class="button" href="inloggen.php?page=registreren">Ik heb geen account</a>
        <?php } ?>

        <!-- 'Ik heb een account' geselecteerd -->

        <?php if (isset($_GET["page"]) && $_GET["page"] === "inloggen") {
            if (isset($_GET["action"]) && $_GET["action"] === "nieuwWachtwoord") { ?>
                <h2 class="title-box">Nieuw wachtwoord</h2>
            <?php
            } else { ?>
                <h2 class="title-box">Inloggen</h2>
            <?php }
            if ($error == "" && isset($_GET["action"]) && $_GET["action"] == "geupdatet") { ?>
                <span class='confirmed'>Uw wachtwoord is geupdatet.</span><br><br>
            <?php
            }
            if (isset($_GET["action"]) && ($_GET["action"] === "nieuwWachtwoord" || $_GET["action"] === "processNieuwWachtwoord")) { ?>
                <!-- Nieuw wachtwoord -->
                <form action="inloggen.php?page=inloggen&action=processNieuwWachtwoord" method="post">
                    <label for="txtEmail">E-mailadres: </label>
                    <input type="email" name="txtEmail" value="<?php if (isset($_SESSION["email"])) {
                                                                    echo $_SESSION["email"];
                                                                } ?>" required><br><br>
                    <label for="txtWachtwoord">Wachtwoord: </label>
                    <input type="password" name="txtWachtwoord"><br><br>
                    <input type="submit" value="Wachtwoord updaten">
                </form>
            <?php
            } else { ?>
                <form action="inloggen.php?page=inloggen&action=processInloggen" method="post">
                    <label for="email">E-mailadres: </label>
                    <input type="email" name="txtEmail" value="<?php if (isset($_SESSION["email"])) {
                                                                    echo $_SESSION["email"];
                                                                } ?>" required><br><br>
                    <label for="wachtwoord">Wachtwoord: </label>
                    <input type="password" name="txtWachtwoord">

                    <input type="submit" value="Inloggen">
                    <p><a class="button small" href="inloggen.php?page=inloggen&action=nieuwWachtwoord">Wachtwoord vergeten?</a></p>
                </form>
            <?php }
            if ($error) {
            ?>
                <p class='error'><?php echo $error; ?></p>
        <?php
            }
        } ?>

        <!-- 'Ik heb geen account' geselecteerd -->

        <?php if (isset($_GET["page"]) && $_GET["page"] === "registreren") { ?>
            <h2 class="title-box">Gegevens</h2>

            <?php
            if ($error) {
            ?>
                <p class='error'><?php echo $error; ?></p>
            <?php
            }
            ?>
            <form action="inloggen.php?page=registreren&action=processRegistreren" method="post">
                <label for="txtNaam">Naam: </label>
                <input type="text" name="txtNaam" value="<?php if (isset($_SESSION["naam"])) {
                                                                echo $_SESSION["naam"];
                                                            } ?>" required>
                <label for="txtVoornaam">Voornaam: </label>
                <input type="text" name="txtVoornaam" value="<?php if (isset($_SESSION["voornaam"])) {
                                                                    echo $_SESSION["voornaam"];
                                                                } ?>" required>
                <label for="txtStraat">Straatnaam: </label>
                <input type="text" name="txtStraat" value="<?php if (isset($_SESSION["straat"])) {
                                                                echo $_SESSION["straat"];
                                                            } ?>" required>
                <label for="txtHuisnummer">Huisnummer: </label>
                <input type="text" name="txtHuisnummer" value="<?php if (isset($_SESSION["huisnummer"])) {
                                                                    echo $_SESSION["huisnummer"];
                                                                } ?>" required>

                <label for="selPostcode">Postcode: </label>
                <select name="selPostcode" required>
                    <?php foreach ($plaatsenLijst as $plaats) {
                        $postcode = $plaats->getPostcode(); ?>
                        <option value="<?php echo $postcode; ?>" <?php if (isset($_SESSION["postcode"]) && ($_SESSION["postcode"] === $postcode)) {
                                                                        echo "selected";
                                                                    } ?>> <?php echo $postcode . " - " . $plaats->getWoonplaats(); ?></option>
                    <?php } ?>
                </select>

                <label for="txtTelefoonnummer">Telefoonnummer: </label>
                <input type="text" name="txtTelefoonnummer" value="<?php if (isset($_SESSION["telefoonnummer"])) {
                                                                        echo "0" . $_SESSION["telefoonnummer"];
                                                                    } ?>" required>
                <label for="txtInfo">Extra informatie: </label>
                <input type="text" name="txtInfo" value="<?php if (isset($_SESSION["info"])) {
                                                                echo $_SESSION["info"];
                                                            } ?>">

                <label for="checkRegistreren">Registreren? </label>
                <input type="checkbox" id="checkRegistreren" name="checkRegistreren" onclick="toonVerborgenInputs()"><br><br>

                <fieldset id="verborgen" style="display: none;">
                    <legend>Registreren</legend>
                    <label for="txtEmail">E-mailadres: </label>
                    <input type="email" name="txtEmail" value="<?php if (isset($_SESSION["email"])) {
                                                                    echo $_SESSION["email"];
                                                                } ?>">
                    <label for="txtWachtwoord">Wachtwoord: </label>
                    <input type="password" name="txtWachtwoord">
                    <label for="txtWachtwoordHerhaal">Herhaal wachtwoord: </label>
                    <input type="password" name="txtWachtwoordHerhaal">
                </fieldset>

                <input type="submit" value="Naar afrekenen">
            </form>

        <?php } ?>

        <!-- Gegevens updaten -->


        <?php if (isset($_GET["page"]) && $_GET["page"] === "gegevensUpdaten") { ?>
            <h2 class="title-box">Gegevens aanpassen</h2>
            <?php
            if ($error) {
            ?>
                <p class='error'><?php echo $error; ?></p>
            <?php } ?>
            <form action="inloggen.php?page=gegevensUpdaten&action=processGegevensUpdaten" method="post">
                <label for="txtNaam">Naam: </label>
                <input type="text" name="txtNaam" value="<?php echo $klant->getKlantNaam() ?>" required>
                <label for="txtVoornaam">Voornaam: </label>
                <input type="text" name="txtVoornaam" value="<?php echo $klant->getKlantVoornaam() ?>" required>
                <label for="txtStraat">Straatnaam: </label>
                <input type="text" name="txtStraat" value="<?php echo $klant->getKlantStraat() ?>" required>
                <label for="txtHuisnummer">Huisnummer: </label>
                <input type="text" name="txtHuisnummer" value="<?php echo $klant->getKlantHuisnummer() ?>" required>
                <label for="selPostcode">Postcode: </label>
                <select name="selPostcode" required>
                    <?php foreach ($plaatsenLijst as $plaats) {
                        $postcode = $plaats->getPostcode(); ?>
                        <option value="<?php echo $postcode; ?>" <?php if ($plaats->getPostcode() === $postcode) {
                                                                        echo "selected";
                                                                    } ?>> <?php echo $postcode . " - " . $plaats->getWoonplaats(); ?></option>
                    <?php } ?>
                </select>
                <label for="txtTelefoonnummer">Telefoonnummer: </label>
                <input type="text" name="txtTelefoonnummer" value="<?php echo "0" . $klant->getKlantTelefoonnummer() ?>" required>
                <label for="txtInfo">Extra informatie: </label>
                <input type="text" name="txtInfo" value="<?php echo $klant->getKlantInfo() ?>">

                <input type="submit" value="Gegevens aanpassen">
            </form>
        <?php } ?>
    </div>
</body>
<footer>
    <div class="row">
        <div class="footer-menu">
            <?php if ((isset($_GET["page"]) && $_GET["page"] === "registreren") || (isset($_GET["action"]) && $_GET["action"] === "nieuwWachtwoord")) { ?>
                <a href="inloggen.php?page=inloggen">Inloggen</a>
            <?php }
            if (isset($_GET["page"]) && $_GET["page"] === "inloggen") { ?>
                <a href="inloggen.php?page=registreren">Registreren</a>
            <?php }
            if (isset($_SESSION["klant"]) && $klant->getKlantEmail() !== "0") { ?>
                <a href="overzicht.php?action=uitloggen">Uitloggen</a>
            <?php } ?>
        </div>
        <p>Copyright &copy; 2023</p>
    </div>
</footer>

</html>