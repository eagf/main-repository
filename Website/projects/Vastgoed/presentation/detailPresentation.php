<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/detail.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <title>Libeer vastgoed</title>
</head>

<body>

    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="pand-details-container">
            <h1 class="detail-title"><?php echo htmlspecialchars($pandDetails['titel']); ?></h1>
            <div class="detail-image-container">
                <?php
                $afbeeldingen = explode(',', $pandDetails['afbeeldingen']);
                foreach ($afbeeldingen as $afbeelding) {
                    echo '<img src="' . htmlspecialchars($afbeelding) . '" class="detail-image" />';
                }
                ?>
            </div>
            <p class="detail-description"><?php echo nl2br(htmlspecialchars($pandDetails['tekst'])); ?></p>
            <div class="detail-info">
                <p><strong>Gemeente:</strong> <?php echo htmlspecialchars($pandDetails['gemeente']); ?></p>
                <p><strong>Prijs:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['prijs'], 2, ',', '.')); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($pandDetails['type']); ?></p>
                <p><strong>Subtype:</strong> <?php echo htmlspecialchars($pandDetails['subtype']); ?></p>
                <p><strong>Aanvulling Subtype:</strong> <?php echo htmlspecialchars($pandDetails['aanvullingSubtype']); ?></p>
                <p><strong>Bouwjaar:</strong> <?php echo htmlspecialchars((string)$pandDetails['bouwjaar']); ?></p>
                <p><strong>Bruto Vloeroppervlakte:</strong> <?php echo htmlspecialchars((string)$pandDetails['brutoVloeroppervlakte']); ?> m²</p>
                <p><strong>Grondoppervlakte:</strong> <?php echo htmlspecialchars((string)$pandDetails['grondoppervlakte']); ?> m²</p>
                <p><strong>Aantal Slaapkamers:</strong> <?php echo htmlspecialchars((string)$pandDetails['aantalSlaapkamers']); ?></p>
                <p><strong>Kadastraal Inkomen:</strong> € <?php echo htmlspecialchars(number_format((float)$pandDetails['kadastraalInkomen'], 2, ',', '.')); ?></p>
                <p><strong>Registratierechten of BTW:</strong> <?php echo htmlspecialchars($pandDetails['registratierechtenBTW']); ?></p>
                <p><strong>Vrij Op:</strong> <?php echo htmlspecialchars($pandDetails['vrijOp']); ?></p>

                <?php if (!empty($pandDetails['kamers'])) : ?>
                    <div class="rooms-container">
                        <?php foreach ($pandDetails['kamers'] as $roomType => $rooms) : ?>
                            <h3><?php echo htmlspecialchars($roomType); ?></h3>
                            <ul>
                                <?php foreach ($rooms as $room) : ?>
                                    <li>
                                        Naam: <?php echo htmlspecialchars($room['kamerNaam']); ?>,
                                        Oppervlakte: <?php echo htmlspecialchars($room['kamerOppervlakte']); ?> m²,
                                        Detail: <?php echo htmlspecialchars($room['kamerDetail']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


                <h3>Wettelijke Informatie</h3>
                <p><strong>EPC Index:</strong> <?php echo htmlspecialchars($pandDetails['epcIndex']); ?></p>
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
        </div>

        <?php include('includes/footer.php'); ?>
</body>

</html>