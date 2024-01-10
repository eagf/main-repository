<?php

declare(strict_types=1);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Afrekenen</title>
    <link rel="icon" type="image/x-icon" href="Presentation/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css" />
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
        <h2 class="title-box">Afrekenen</h2>
        <?php if (isset($_GET["action"]) && $_GET["action"] === "geregistreerd") { ?>
            <span class='confirmed'>Je bent geregistreerd!</span><br><br>
        <?php } ?>
        <h3 class="title-box">Bestelling</h3>

        <?php if (!empty($winkelmandLijst)) { ?>
            <table>
                <tr>
                    <th>Naam</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                </tr>
                <?php
                if ($klantPromo === 1) {
                    $totaal = 0.00;
                    $totaalPromo = 0.00;
                    foreach ($winkelmandLijst as $winkelmandProduct) {
                        $productId = (int) $winkelmandProduct["productId"];
                        $product = $productSrv->getProductByProductId($productId);
                        $aantal = (int) $winkelmandProduct["aantal"];
                        $productTotaal = number_format($product->getProductprijs() * $aantal, 2);
                        $productTotaalPromo = number_format($product->getProductPromotieprijs() * $aantal, 2);
                        $totaal += $productTotaal;
                        $totaalPromo += $productTotaalPromo ?>
                        <tr>
                            <td><?php echo $product->getProductNaam() ?></td>
                            <td><?php echo $aantal ?></td>
                            <td class="auto-width">€ <s><?php echo $productTotaal ?></s> <?php echo $productTotaalPromo ?></td>
                        </tr>
                    <?php
                    } ?>
            </table>
            <p class="total">Totaal: € <s><?php echo number_format((float)$totaal, 2) ?></s> <?php echo number_format((float)$totaalPromo, 2) ?></p>

            <?php } else {
                    $totaal = 0.00;
                    foreach ($winkelmandLijst as $winkelmandProduct) {
                        $productId = (int) $winkelmandProduct["productId"];
                        $product = $productSrv->getProductByProductId($productId);
                        $aantal = (int) $winkelmandProduct["aantal"];
                        $productTotaal = number_format($product->getProductprijs() * $aantal, 2);
                        $totaal += $productTotaal; ?>
                <tr>
                    <td><?php echo $product->getProductNaam() ?></td>
                    <td><?php echo $aantal ?></td>
                    <td class="auto-width">€ <?php echo $productTotaal ?></td>
                </tr>
            <?php
                    } ?>
            </table>
            <p class="total">Totaal: € <?php echo number_format((float)$totaal, 2) ?></p>
        <?php }
        ?>
        <a class="button" href="overzicht.php">Bestelling aanpassen</a><br>

        <h3 class="title-box">Gegevens</h3>
        <table>
            <tr>
                <td>Naam</td>
                <td><?php echo $klant->getKlantNaam() ?></td>
            </tr>
            <tr>
                <td>Voornaam</td>
                <td><?php echo $klant->getKlantVoornaam() ?></td>
            </tr>
            <tr>
                <td>Straat</td>
                <td><?php echo $klant->getKlantStraat() ?></td>
            </tr>
            <tr>
                <td>Huisnummer</td>
                <td><?php echo $klant->getKlantHuisnummer() ?></td>
            </tr>
            <tr class=<?php if ($leverbaar === 0) {
                            echo "error";
                        } ?>>
                <td>Postcode</td>
                <td><?php echo $plaats->getPostcode() ?></td>
            </tr>
            <tr>
                <td>Gemeente</td>
                <td><?php echo $plaats->getWoonplaats() ?></td>
            </tr>
            <tr>
                <td>Telefoonnummer</td>
                <td><?php echo "0" . $klant->getKlantTelefoonnummer() ?></td>
            </tr>
            <tr>
                <td>Extra informatie</td>
                <td><?php echo $klant->getKlantInfo() ?></td>
            </tr>
        </table><br>
        <?php if (isset($_GET["action"]) && $_GET["action"] === "geupdatet") { ?>
            <span class='confirmed'>Je gegevens zijn geupdatet.</span><br><br>
        <?php } ?>
        <a class="button" href="inloggen.php?page=gegevensUpdaten">Gegevens aanpassen</a><br><br>

        <?php if ($leverbaar === 1) { ?>
            <form id="bestellen" action="afrekenen.php?action=process" method="post">
                <label for="txtBestelInfo">Extra info voor bestelling: </label>
                <input type="text" name="txtBestelInfo"><br><br>
                <input id="submit-bestellen" type="submit" value="Bestelling plaatsen">
            </form>
        <?php
            } else { ?>
            <p class='error'>In jouw gemeente kan er niet geleverd worden!</p>
        <?php }
        } else { ?>
        <p>Je winkelmandje is leeg.</p>
        <a class="button" href="overzicht.php">Plaats een bestelling</a><br><br>
    <?php }
        if (isset($_GET["action"]) && $_GET["action"] === "besteld") { ?>
        <span class='confirmed'>De bestelling is geplaatst.</span><br><br>
        <div id="gif-container">
            <img id="gif" src="Presentation\img\confetti.gif" alt="confetti">
        </div>
        <script>
            const gifContainer = document.getElementById('gif-container');
            gifContainer.style.display = 'block';
            setTimeout(() => {
                gifContainer.style.display = 'none';
            }, 10000);
        </script>
    <?php } ?>
    </div>
</body>

<footer>
    <div class="row">
        <div class="footer-menu">
            <?php if (isset($_SESSION["klant"]) && $klant->getKlantEmail() === "0") { ?>
                <a href="inloggen.php?action=uitloggen">Gegevens leegmaken</a>
            <?php }
            if (isset($_SESSION["klant"]) && $klant->getKlantEmail() !== "0") { ?>
                <a href="overzicht.php?action=uitloggen">Uitloggen</a>
            <?php }
            if (isset($_SESSION["klant"])) { ?>
                <a href="afrekenen.php?action=toggleKlantPromo">Toggle klantpromo</a>
            <?php } ?>
        </div>
        <p>Copyright &copy; 2023</p>
    </div>
</footer>

</html>