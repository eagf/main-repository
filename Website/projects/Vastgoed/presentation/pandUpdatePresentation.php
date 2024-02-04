<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <title>Aanpassen</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="form-container">

            <?php if (isset($message)) {
                echo "<p class='success'>" . $message . "</p>";
            } ?>

            <h2>Gegevens</h2>

            <form action="pandUpdate.php" method="GET">
                <h3>Selecteren</h3>
                <label for="pandID">Selecteer een pand:</label>
                <select id="pandID" name="pandID">
                    <?php getPandenSelect(); ?>
                </select>
                <br>
                <button type="submit">Ga naar gegevens</button>
            </form>

            <?php if ($pandID) {

                getPandDetailsByPandID($pandID);

            ?>
                <form action="./data/pandUpdateBackend.php" method="POST">

                    <h3>Gegevens aanpassen</h3>
                    <!-- CONTROL STILL IN CODE!!!!!!!!!!!!!!!! -->
                    <h3 style="color: red">De gegevens van de eerste 5 voorbeelden zijn nog niet aan te passen.</h3>
                    <!-- CONTROL STILL IN CODE!!!!!!!!!!!!!!!! -->

                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">

                    <!-- Adressen fields -->
                    <div><label for="land">Land:</label><input type="text" id="land" name="land" placeholder="Land" value="<?php echo htmlspecialchars($pandDetails['land'] ?? ''); ?>" required></div>
                    <div><label for="postcode">Postcode:</label><input type="text" id="postcode" name="postcode" placeholder="Postcode" value="<?php echo htmlspecialchars($pandDetails['postcode'] ?? ''); ?>" required></div>
                    <div><label for="gemeente">Gemeente:</label><input type="text" id="gemeente" name="gemeente" placeholder="Gemeente" value="<?php echo htmlspecialchars($pandDetails['gemeente'] ?? ''); ?>" required></div>
                    <div><label for="straat">Straat:</label><input type="text" id="straat" name="straat" placeholder="Straat" value="<?php echo htmlspecialchars($pandDetails['straat'] ?? ''); ?>" required></div>
                    <div><label for="nr">Nummer:</label><input type="text" id="nr" name="nr" placeholder="Nummer" value="<?php echo htmlspecialchars($pandDetails['nr'] ?? ''); ?>" required></div>
                    <div><label for="bus">Bus:</label><input type="text" id="bus" name="bus" placeholder="Bus" value="<?php echo htmlspecialchars($pandDetails['bus'] ?? ''); ?>"></div>
                    <div><label for="adresOpAanvraag">Adres op aanvraag:</label><input type="checkbox" id="adresOpAanvraag" name="adresOpAanvraag" value="1" <?php echo ($pandDetails['adresOpAanvraag'] ?? 0) ? 'checked' : ''; ?>></div>

                    <!-- Wettelijke Informatie Fields -->
                    <div><label for="epcIndex">EPC Index:</label><input type="text" id="epcIndex" name="epcIndex" placeholder="EPC Index" value="<?php echo htmlspecialchars($pandDetails['epcIndex'] ?? ''); ?>" required></div>
                    <div><label for="energieLabel">Energie Label:</label><input type="text" id="energieLabel" name="energieLabel" placeholder="Energie Label" value="<?php echo htmlspecialchars($pandDetails['energieLabel'] ?? ''); ?>" required></div>
                    <div><label for="stedenbouwkundigeVergunning">Stedenbouwkundige Vergunning:</label><input type="checkbox" id="stedenbouwkundigeVergunning" name="stedenbouwkundigeVergunning" value="1" <?php echo ($pandDetails['stedenbouwkundigeVergunning'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="verkavelingsvergunning">Verkavelingsvergunning:</label><input type="checkbox" id="verkavelingsvergunning" name="verkavelingsvergunning" value="1" <?php echo ($pandDetails['verkavelingsvergunning'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="voorkooprecht">Voorkooprecht:</label><input type="checkbox" id="voorkooprecht" name="voorkooprecht" value="1" <?php echo ($pandDetails['voorkooprecht'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="stedenbouwkundigeBestemming">Stedenbouwkundige Bestemming:</label><input type="text" id="stedenbouwkundigeBestemming" name="stedenbouwkundigeBestemming" placeholder="Stedenbouwkundige Bestemming" value="<?php echo htmlspecialchars($pandDetails['stedenbouwkundigeBestemming'] ?? ''); ?>" required></div>
                    <div><label for="dagvaardingEnHerstelvordering">Dagvaarding en Herstelvordering:</label><input type="checkbox" id="dagvaardingEnHerstelvordering" name="dagvaardingEnHerstelvordering" value="1" <?php echo ($pandDetails['dagvaardingEnHerstelvordering'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="effectiefOverstromingsgevoelig">Effectief Overstromingsgevoelig:</label><input type="checkbox" id="effectiefOverstromingsgevoelig" name="effectiefOverstromingsgevoelig" value="1" <?php echo ($pandDetails['effectiefOverstromingsgevoelig'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="mogelijkOverstromingsgevoelig">Mogelijk Overstromingsgevoelig:</label><input type="checkbox" id="mogelijkOverstromingsgevoelig" name="mogelijkOverstromingsgevoelig" value="1" <?php echo ($pandDetails['mogelijkOverstromingsgevoelig'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="afgebakendOverstromingsgebied">Afgebakend Overstromingsgebied:</label><input type="checkbox" id="afgebakendOverstromingsgebied" name="afgebakendOverstromingsgebied" value="1" <?php echo ($pandDetails['afgebakendOverstromingsgebied'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="afgebakendeOeverzone">Afgebakende Oeverzone:</label><input type="checkbox" id="afgebakendeOeverzone" name="afgebakendeOeverzone" value="1" <?php echo ($pandDetails['afgebakendeOeverzone'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="risicozoneVoorOverstromingen">Risicozone voor Overstromingen:</label><input type="checkbox" id="risicozoneVoorOverstromingen" name="risicozoneVoorOverstromingen" value="1" <?php echo ($pandDetails['risicozoneVoorOverstromingen'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="overstromingskansPerceel">Overstromingskans Perceel (P-score):</label><input type="text" id="overstromingskansPerceel" name="overstromingskansPerceel" placeholder="Overstromingskans Perceel (P-score)" value="<?php echo htmlspecialchars($pandDetails['overstromingskansPerceel'] ?? ''); ?>" required></div>
                    <div><label for="overstromingskansGebouw">Overstromingskans Gebouw (G-score):</label><input type="text" id="overstromingskansGebouw" name="overstromingskansGebouw" placeholder="Overstromingskans Gebouw (G-score)" value="<?php echo htmlspecialchars($pandDetails['overstromingskansGebouw'] ?? ''); ?>" required></div>
                    <div><label for="erfgoed">Erfgoed:</label><input type="checkbox" id="erfgoed" name="erfgoed" value="1" <?php echo ($pandDetails['erfgoed'] ?? 0) ? 'checked' : ''; ?>></div>

                    <!-- Panddetails fields -->
                    <div><label for="isNieuw">Is Nieuw:</label><input type="checkbox" id="isNieuw" name="isNieuw" value="1" <?php echo ($pandDetails['isNieuw'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="isOpbrengsteigendom">Is Opbrengsteigendom:</label><input type="checkbox" id="isOpbrengsteigendom" name="isOpbrengsteigendom" value="1" <?php echo ($pandDetails['isOpbrengsteigendom'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="isExclusiefVastgoed">Is Exclusief Vastgoed:</label><input type="checkbox" id="isExclusiefVastgoed" name="isExclusiefVastgoed" value="1" <?php echo ($pandDetails['isExclusiefVastgoed'] ?? 0) ? 'checked' : ''; ?>></div>
                    <div><label for="isBeleggingsvastgoed">Is Beleggingsvastgoed:</label><input type="checkbox" id="isBeleggingsvastgoed" name="isBeleggingsvastgoed" value="1" <?php echo ($pandDetails['isBeleggingsvastgoed'] ?? 0) ? 'checked' : ''; ?>></div>

                    <!-- pand fields -->
                    <div><label for="titel">Titel:</label><input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($pandDetails['titel'] ?? ''); ?>" required></div>
                    <div><label for="tekst">Tekst:</label><textarea id="tekst" name="tekst" required><?php echo htmlspecialchars($pandDetails['tekst'] ?? ''); ?></textarea></div>
                    <div><label for="status">Status:</label><input type="text" id="status" name="status" value="<?php echo htmlspecialchars($pandDetails['status'] ?? ''); ?>" required></div>
                    <div><label for="type">Type:</label><input type="text" id="type" name="type" value="<?php echo htmlspecialchars($pandDetails['type'] ?? ''); ?>" required></div>
                    <div><label for="subtype">Subtype:</label><input type="text" id="subtype" name="subtype" value="<?php echo htmlspecialchars($pandDetails['subtype'] ?? ''); ?>" required></div>
                    <div><label for="aanvullingSubtype">Aanvulling Subtype:</label><input type="text" id="aanvullingSubtype" name="aanvullingSubtype" value="<?php echo htmlspecialchars($pandDetails['aanvullingSubtype'] ?? ''); ?>" required></div>
                    <div><label for="bouwjaar">Bouwjaar:</label><input type="number" id="bouwjaar" name="bouwjaar" value="<?php echo htmlspecialchars($pandDetails['bouwjaar'] ?? ''); ?>" required></div>
                    <div><label for="brutoVloeroppervlakte">Bruto Vloeroppervlakte:</label><input type="number" id="brutoVloeroppervlakte" name="brutoVloeroppervlakte" value="<?php echo htmlspecialchars($pandDetails['brutoVloeroppervlakte'] ?? ''); ?>" required></div>
                    <div><label for="grondoppervlakte">Grondoppervlakte:</label><input type="number" id="grondoppervlakte" name="grondoppervlakte" value="<?php echo htmlspecialchars($pandDetails['grondoppervlakte'] ?? ''); ?>" required></div>
                    <div><label for="aantalSlaapkamers">Aantal Slaapkamers:</label><input type="number" id="aantalSlaapkamers" name="aantalSlaapkamers" value="<?php echo htmlspecialchars($pandDetails['aantalSlaapkamers'] ?? ''); ?>" required></div>
                    <div><label for="prijs">Prijs:</label><input type="number" id="prijs" name="prijs" value="<?php echo htmlspecialchars($pandDetails['prijs'] ?? ''); ?>" required></div>
                    <div><label for="kadastraalInkomen">Kadastraal Inkomen:</label><input type="number" id="kadastraalInkomen" name="kadastraalInkomen" value="<?php echo htmlspecialchars($pandDetails['kadastraalInkomen'] ?? ''); ?>" required></div>
                    <div><label for="registratierechtenBTW">Registratierechten/BTW:</label><input type="text" id="registratierechtenBTW" name="registratierechtenBTW" value="<?php echo htmlspecialchars($pandDetails['registratierechtenBTW'] ?? ''); ?>" required></div>
                    <div><label for="vrijOp">Vrij Op:</label><input type="text" id="vrijOp" name="vrijOp" value="<?php echo htmlspecialchars($pandDetails['vrijOp'] ?? ''); ?>" required></div>

                    <!-- Kamers Fields -->
                    <div class="rooms-container">
                        <?php if (!empty($pandDetails['kamers'])) : ?>
                            <?php foreach ($pandDetails['kamers'] as $roomType => $rooms) : ?>
                                <h3><?php echo htmlspecialchars($roomType); ?></h3>
                                <div class="room-fields-container">
                                    <?php foreach ($rooms as $room) : ?>
                                        <div class="room-field">
                                            <input type="hidden" name="kamerID[]" value="<?php echo htmlspecialchars($room['kamerID']); ?>">
                                            <div><label for="kamerNaam<?php echo $room['kamerID']; ?>">Kamer Naam:</label><input type="text" id="kamerNaam<?php echo $room['kamerID']; ?>" name="kamerNaam[]" value="<?php echo htmlspecialchars($room['kamerNaam']); ?>" required></div>
                                            <div><label for="kamerOppervlakte<?php echo $room['kamerID']; ?>">Kamer Oppervlakte:</label><input type="number" id="kamerOppervlakte<?php echo $room['kamerID']; ?>" name="kamerOppervlakte[]" value="<?php echo htmlspecialchars($room['kamerOppervlakte']); ?>" required></div>
                                            <div><label for="kamerDetail<?php echo $room['kamerID']; ?>">Kamer Detail:</label><textarea id="kamerDetail<?php echo $room['kamerID']; ?>" name="kamerDetail[]"><?php echo htmlspecialchars($room['kamerDetail']); ?></textarea></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="submit">Gegevens aanpassen</button>

                </form>
            <?php } ?>

        </div>

        <?php include('includes/footer.php'); ?>
</body>

</html>