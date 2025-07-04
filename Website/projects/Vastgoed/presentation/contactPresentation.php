<!-- contactPresentation.php -->
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
            <h1 class="contact-title">Contactformulier</h1>

            <?php
            if ($status === 'success') {
                echo '<div class="alert success">Bedankt voor uw bericht. We nemen zo snel mogelijk contact met u op.</div>';
            } elseif ($status === 'error') {
                $errorText = '';
                switch ($message) {
                    case 'invalid_email':
                        $errorText = 'Ongeldig e-mailadres. Probeer het opnieuw.';
                        break;
                    case 'email_failure':
                        $errorText = 'Er is een fout opgetreden bij het verzenden van uw bericht. Probeer het later opnieuw.';
                        break;
                    case 'invalid_access':
                        $errorText = 'Ongeldige toegang. Gebruik het contactformulier.';
                        break;
                    default:
                        $errorText = 'Er is een fout opgetreden. Probeer het later opnieuw.';
                }
                echo '<div class="alert error">' . $errorText . '</div>';
            }
        ?>

            <form class="contact-form" action="./data/submitContactForm.php" method="post">
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
                <div class="form-submit-container">
                    <button class="form-submit" onmouseover="changeImage()" onmouseout="resetImage()" type="submit">
                        <p class="submit-text">Verstuur</p>
                        <img src="./assets/img/Bereklauw-orange.png" alt="Verstuur" class="submit-button" id="submitImage">
                    </button>

                    <script>
                        function changeImage() {
                            document.getElementById('submitImage').src = './assets/img/Bereklauw.png';
                        }

                        function resetImage() {
                            document.getElementById('submitImage').src = './assets/img/Bereklauw-orange.png';
                        }
                    </script>

                </div>
                <p class="policy-link">
                    Door dit formulier te verzenden accepteert u onze <a href="policy.php">algemene gebruiksvoorwaarden</a>.
                </p>

            </form>

             <div class="contact-details">
                <p class="contact-address">Libeer Vastgoed<br>Gouvernementstraat 32, 9000 Gent<br>BE0772.543.830<br>BA en borgstelling via NV AXA Belgium (polisnr. 30.390.160)</p>
                <img src="./assets/img/MichaelLibeer.png" alt="Michaël Libeer" class="contact-photo">
                <p class="contact-realtor">Michaël Libeer<br>BIV 514<br>Erkend vastgoedmakelaar-bemiddelaar</p>
                <p class="contact-credentials">Erkend in België<br>Als erkend vastgoedmakelaar-bemiddelaar onderworpen aan <a href="https://www.biv.be/vastgoedmakelaar-biv/deontologie-van-de-vastgoedmakelaar">de BIV-plichtenleer</a><br>Toezichthoudende autoriteit: Beroepsinstituut van Vastgoedmakelaars, Luxemburgstraat 16B, 1000 Brussel</p>
                <p class="contact-info">0477/92.81.99<br><a href="mailto:info@michaellibeer.be" class="email-link">info@michaellibeer.be</a></p>
            </div>

        </div>

    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>