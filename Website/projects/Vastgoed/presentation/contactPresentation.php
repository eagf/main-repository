<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/contact.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <title>Libeer vastgoed</title>
</head>

<body>
    <div id="wrapper">
        <?php include("includes/header.php"); ?>

        <div class="contact-container">
            <form class="contact-form" action="submit_contact_form.php" method="post">
                <div class="form-field">
                    <label for="naam">Naam</label>
                    <input type="text" id="naam" name="naam" required>
                </div>
                <div class="form-field">
                    <label for="voornaam">Voornaam</label>
                    <input type="text" id="voornaam" name="voornaam" required>
                </div>
                <div class="form-field">
                    <label for="email">E-mailadres</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-field">
                    <label for="onderwerp">Onderwerp</label>
                    <input type="text" id="onderwerp" name="onderwerp" required>
                </div>
                <div class="form-field">
                    <label for="message">Bericht</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="form-submit">
                    <p class="submit-text">Verstuur</p>
                    <img src="./assets/img/Bereklauw.png" alt="Verstuur" class="submit-button">
                </div>
            </form>
        </div>

    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>