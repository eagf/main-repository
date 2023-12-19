<?php

declare(strict_types=1);
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Overzicht producten</title>
    <link rel="icon" type="image/x-icon" href="Presentation/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="Presentation/css/default.css" />
</head>

<body>
    <div class="header">

        <a href="overzicht.php" class="logoHeader">Pizzeria: 'Paperella di Gomma'</a>
        <div class="header-right">
            <a class="active" href="overzicht.php">Overzicht</a>
            <a href="afrekenen.php">Afrekenen</a>
            <a href="info.php">Info</a>
        </div>

    </div>

    <div class="body-underheader">

        <h2 class="title-box">Overzicht producten</h2>
        <p>Maak hieronder een selectie van jouw gewenste product(en):</p>
        <table>
            <tr>
                <th></th>
                <th>Naam</th>
                <th>Samenstelling</th>
                <th>Prijs</th>
                <th>Toevoegen</th>
            </tr>
            <?php if (isset($_SESSION["klant"]) && $klantPromo === 1) {
                foreach ($productLijst as $product) { 
                    $productId = $product->getProductId(); ?>

                    <tr id="<?php echo $productId ?>">
                        <td><img class="img-product" src="Presentation/img/<?php echo $productId ?>.png"></td>
                        <td><?php echo $product->getProductNaam() ?></td>
                        <td><?php echo $product->getProductSamenstelling() ?></td>
                        <td class="auto-width">€ <s><?php echo $product->getProductprijs() ?></s> <?php echo $product->getProductPromotieprijs() ?></td>
                        <td class="right-align"><a href="overzicht.php?action=add&productId=<?php echo $product->getProductId() ?>"><img class="img-icon" src="Presentation/img/add.png"></a></td>
                    </tr>
                <?php }
            } else {
                foreach ($productLijst as $product) {
                    $productId = $product->getProductId(); ?>
                    <tr id="<?php echo $productId ?>">
                        <td><img class="img-product" src="Presentation/img/<?php echo $productId ?>.png"></td>
                        <td><?php echo $product->getProductNaam() ?></td>
                        <td><?php echo $product->getProductSamenstelling() ?></td>
                        <td class="auto-width">€ <?php echo $product->getProductprijs() ?></td>
                        <td class="right-align"><a href="overzicht.php?action=add&productId=<?php echo $product->getProductId() ?>"><img class="img-icon" src="Presentation/img/add.png"></a></td>
                    </tr>
            <?php }
            } ?>
        </table><br>
        <h3 id="winkelmand" class="title-box">Winkelmandje</h3>
        <?php if (!empty($winkelmandLijst)) { ?>
            <table>
                <tr>
                    <th>Naam</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Verwijderen</th>
                </tr>
                <?php
                if (isset($_SESSION["klant"]) && $klantPromo === 1) {
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
                            <td class="right-align"><a href="overzicht.php?action=remove&productId=<?php echo $productId ?>"><img class="img-icon" src="Presentation/img/remove.png"></a></td>
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
                    <td class="right-align"><a href="overzicht.php?action=remove&productId=<?php echo $productId ?>"><img class="img-icon" src="Presentation/img/remove.png"></a></td>
                </tr>
            <?php
                    } ?>
            </table>
            <p class="total">Totaal: € <?php echo number_format((float)$totaal, 2) ?></p>
        <?php }
        ?>
        <a class="button" href="overzicht.php?action=leegmaken">Winkelmandje leegmaken</a><br><br>
        <a class="button" href="overzicht.php?action=afrekenen">Afrekenen</a><br><br>
    <?php } else { ?>
        <p>Je winkelmandje is leeg.</p>
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
                <a href="overzicht.php?action=toggleKlantPromo">Toggle klantpromo</a>
            <?php } ?>

        </div>
        <p>Copyright &copy; 2023</p>
    </div>

</footer>

</html>