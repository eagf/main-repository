<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/detail.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="scripts/detail.js" defer></script>
    <title>Libeer vastgoed</title>
</head>

<body>

    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div id="pand-details-container">

            <div id="titel-container">
                <h1><?php echo htmlspecialchars($pandDetails['titel']); ?></h1>
            </div>

            <!-- ============== carousel ============== -->

            <div class="detail-carousel">
                <div class="arrow left-arrow"></div>
                <div class="detail-image-container">
                    <?php
                    $afbeeldingen = explode(',', $pandDetails['afbeeldingen']);
                    foreach ($afbeeldingen as $afbeelding) {
                        echo '<div class="detail-image" style="background-image: url(' . htmlspecialchars($afbeelding) . ');"></div>';
                    }
                    ?>
                </div>
                <div class="arrow right-arrow"></div>
            </div>

            <!-- ============== verdere info ============== -->

            <div id="adres-type-container" class="detail-container">
                <p><strong>Adres:</strong>
                    <?php
                    echo (
                        htmlspecialchars($pandDetails['straat']) . " " .
                        htmlspecialchars($pandDetails['nr']) .
                        (!empty($pandDetails['bus']) ? " bus " . htmlspecialchars($pandDetails['bus']) : "") . " - " .
                        htmlspecialchars($pandDetails['postcode']) . " " .
                        htmlspecialchars($pandDetails['gemeente'])
                    );
                    ?>
                </p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($pandDetails['type']); ?></p>
                <?php if ($pandDetails['subtype'] != "Standaard") : ?>
                    <p><strong>Subtype:</strong> <?php echo htmlspecialchars($pandDetails['subtype']); ?></p>
                    <p><strong>Aanvulling Subtype:</strong> <?php echo htmlspecialchars($pandDetails['aanvullingSubtype']); ?></p>
                <?php endif; ?>
                <div id="google-maps-link-container">
                    <?php
                    echo "<a href=\"{$googleMapsLink}\" target=\"_blank\">Bekijk op Google Maps</a>";
                    ?>
                </div>
            </div>


            <div id="beschrijving-container" class="detail-container">
                <p><?php echo nl2br(htmlspecialchars($pandDetails['tekst'])); ?></p>
            </div>

            <div id="info1-container" class="detail-container">
                <p><strong>Prijs:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['prijs'], 2, ',', '.')); ?></p>
                <p><strong>Registratierechten of BTW:</strong> <?php echo htmlspecialchars($pandDetails['registratierechtenBTW']); ?></p>
                <p><strong>Vrij Op:</strong> <?php echo htmlspecialchars($pandDetails['vrijOp']); ?></p>
                <p><strong>Kadastraal Inkomen:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['kadastraalInkomen'], 2, ',', '.')); ?></p>
            </div>

            <div id="info2-container" class="detail-container">
                <p><strong>Bouwjaar:</strong> <?php echo htmlspecialchars((string)$pandDetails['bouwjaar']); ?></p>

                <p><strong>Grondoppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['grondoppervlakte'], 0, ',', '.')); ?> m²</p>
                <p><strong>Bruto Vloeroppervlakte:</strong> <?php echo htmlspecialchars(number_format((float)$pandDetails['brutoVloeroppervlakte'], 0, ',', '.')); ?> m²</p>
                <!-- !!!!!!! Onleesbaar in geschreven overzicht -->
                <p><strong>EPC Index:</strong> <?php echo htmlspecialchars(number_format($pandDetails['epcIndex']), 0); ?></p>
            </div>

            <!-- ============== kamers / indeling ============== -->

            <?php if (!empty($pandDetails['kamers'])) : ?>
                <div id="indeling-container" class="detail-container">
                    <h3>Indeling</h3>
                    <?php foreach ($pandDetails['kamers'] as $roomType => $rooms) : ?>
                        <h4><?php echo htmlspecialchars($roomType); ?></h4>
                        <ul>
                            <?php
                            $roomCounter = 1;
                            $showCounter = count($rooms) >= 2;
                            ?>
                            <?php foreach ($rooms as $room) : ?>
                                <li>
                                    <?php
                                    if ($showCounter) {
                                        echo $roomCounter++ . ': ';
                                    }
                                    ?>
                                    Oppervlakte: <?php echo htmlspecialchars(number_format($room['kamerOppervlakte'], 0, ',', '.')); ?> m²,
                                    Detail: <?php echo htmlspecialchars($room['kamerDetail']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



            <!-- ============== wettelijke informatie ============== -->

            <div id="wettelijke-container" class="detail-container">
                <h3>Wettelijke Informatie</h3>
                <p><strong>Energie Label:</strong> <?php echo htmlspecialchars($pandDetails['energieLabel']); ?></p>
                <p><strong>Stedenbouwkundige Vergunning:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeVergunning'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Verkavelingsvergunning:</strong> <?php echo htmlspecialchars($pandDetails['verkavelingsvergunning'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Voorkooprecht:</strong> <?php echo htmlspecialchars($pandDetails['voorkooprecht'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Stedenbouwkundige Bestemming:</strong> <?php echo htmlspecialchars($pandDetails['stedenbouwkundigeBestemming']); ?></p>
                <p><strong>Dagvaarding en Herstelvordering:</strong> <?php echo htmlspecialchars($pandDetails['dagvaardingEnHerstelvordering'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['effectiefOverstromingsgevoelig'] ? 'Effectief overstromingsgevoelig' : 'Niet effectief overstromingsgevoelig'); ?></p>
                <p><strong>Mogelijk Overstromingsgevoelig:</strong> <?php echo htmlspecialchars($pandDetails['mogelijkOverstromingsgevoelig'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Afgebakend Overstromingsgebied:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendOverstromingsgebied'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Afgebakende Oeverzone:</strong> <?php echo htmlspecialchars($pandDetails['afgebakendeOeverzone'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Risicozone voor Overstromingen:</strong> <?php echo htmlspecialchars($pandDetails['risicozoneVoorOverstromingen'] ? 'Ja' : 'Nee'); ?></p>
                <p><strong>Overstromingskans Perceel (P-score):</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansPerceel']); ?></p>
                <p><strong>Overstromingskans Gebouw (G-score):</strong> <?php echo htmlspecialchars((string)$pandDetails['overstromingskansGebouw']); ?></p>
                <p><strong>Erfgoed:</strong> <?php echo htmlspecialchars($pandDetails['erfgoed'] ? 'Ja' : 'Nee'); ?></p>
            </div>

            <!-- Ongebruikte gegevens -->
            <!-- <p><strong>Gemeente:</strong> <?php echo htmlspecialchars($pandDetails['gemeente']); ?></p>
                <p><strong>Aantal Slaapkamers:</strong> <?php echo htmlspecialchars((string)$pandDetails['aantalSlaapkamers']); ?></p> -->

        </div>

        <?php include('includes/footer.php'); ?>
</body>

</html>