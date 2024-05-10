<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="scripts/pandUpdate.js" defer></script>
    <title>Aanpassen</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="back-to-admin">
            <a href="admin.php" class="back-button">Back to Admin Page</a>
        </div>

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

                    <!-- pand fields -->
                    <div><label for="titel">Titel:</label><input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($pandDetails['titel'] ?? ''); ?>" required></div>
                    <div><label for="tekst">Tekst:</label><textarea id="tekst" name="tekst" required><?php echo htmlspecialchars($pandDetails['tekst'] ?? ''); ?></textarea></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="homepage" name="homepage" value="1" <?php echo ($pandDetails['homepage'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="homepage" class="checkbox-label">Op homepage</label>
                    </div>
                    <div>
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Te koop" <?php echo (isset($pandDetails['status']) && $pandDetails['status'] == 'Te koop') ? 'selected' : ''; ?>>Te koop</option>
                            <option value="Te huur" <?php echo (isset($pandDetails['status']) && $pandDetails['status'] == 'Te huur') ? 'selected' : ''; ?>>Te huur</option>
                        </select>
                    </div>
                    <div><label for="type">Type:</label><input type="text" id="type" name="type" value="<?php echo htmlspecialchars($pandDetails['type'] ?? ''); ?>" required></div>
                    <div><label for="subtype">Subtype:</label><input type="text" id="subtype" name="subtype" value="<?php echo htmlspecialchars($pandDetails['subtype'] ?? ''); ?>"></div>
                    <div><label for="aanvullingSubtype">Aanvulling Subtype:</label><input type="text" id="aanvullingSubtype" name="aanvullingSubtype" value="<?php echo htmlspecialchars($pandDetails['aanvullingSubtype'] ?? ''); ?>"></div>
                    <div><label for="bouwjaar">Bouwjaar:</label><input type="number" id="bouwjaar" name="bouwjaar" value="<?php echo htmlspecialchars($pandDetails['bouwjaar'] ?? ''); ?>" required></div>
                    <div><label for="brutoVloeroppervlakte">Bruto Vloeroppervlakte:</label><input type="number" id="brutoVloeroppervlakte" name="brutoVloeroppervlakte" value="<?php echo htmlspecialchars($pandDetails['brutoVloeroppervlakte'] ?? ''); ?>" required></div>
                    <div><label for="grondoppervlakte">Grondoppervlakte:</label><input type="number" id="grondoppervlakte" name="grondoppervlakte" value="<?php echo htmlspecialchars($pandDetails['grondoppervlakte'] ?? ''); ?>" required></div>
                    <div><label for="aantalSlaapkamers">Aantal Slaapkamers:</label><input type="number" id="aantalSlaapkamers" name="aantalSlaapkamers" value="<?php echo htmlspecialchars($pandDetails['aantalSlaapkamers'] ?? ''); ?>" required></div>
                    <div><label for="prijs">Prijs:</label><input type="number" id="prijs" name="prijs" value="<?php echo htmlspecialchars($pandDetails['prijs'] ?? ''); ?>" required></div>
                    <div><label for="kadastraalInkomen">Kadastraal Inkomen:</label><input type="number" id="kadastraalInkomen" name="kadastraalInkomen" value="<?php echo htmlspecialchars($pandDetails['kadastraalInkomen'] ?? ''); ?>" required></div>
                    <div><label for="bezoekOp">Bezoek op:</label><input type="text" id="bezoekOp" name="bezoekOp" value="<?php echo htmlspecialchars($pandDetails['bezoekOp'] ?? ''); ?>" required></div>

                    <div>
                        <label for="vrijOp">Vrij Op:</label>
                        <select id="vrijOp" name="vrijOp" required onchange="toggleDateInput()">
                            <option value="Onmiddellijk" <?php echo ($pandDetails['vrijOp'] == "Onmiddellijk" ? 'selected' : ''); ?>>Onmiddellijk</option>
                            <option value="Bij akte" <?php echo ($pandDetails['vrijOp'] == "Bij akte" ? 'selected' : ''); ?>>Bij akte</option>
                            <option value="Na opzeg huurcontract">Na opzeg huurcontract</option>
                            <option value="date" <?php echo ($pandDetails['vrijOp']) ? 'selected' : ''; ?>>Datum</option>
                        </select>
                        <input type="date" id="vrijOpDate" name="vrijOpDate" value="<?php echo ($pandDetails['vrijOp']) ? htmlspecialchars($pandDetails['vrijOp']) : ''; ?>" style="display: <?php echo ($pandDetails['vrijOp']) ? 'block' : 'none'; ?>;">
                    </div>

                    <!-- Adressen fields -->
                    <div><label for="land">Land:</label><input type="text" id="land" name="land" placeholder="Land" value="<?php echo htmlspecialchars($pandDetails['land'] ?? ''); ?>" required></div>
                    <div><label for="postcode">Postcode:</label><input type="text" id="postcode" name="postcode" placeholder="Postcode" value="<?php echo htmlspecialchars($pandDetails['postcode'] ?? ''); ?>" required></div>
                    <div><label for="gemeente">Gemeente:</label><input type="text" id="gemeente" name="gemeente" placeholder="Gemeente" value="<?php echo htmlspecialchars($pandDetails['gemeente'] ?? ''); ?>" required></div>
                    <div><label for="straat">Straat:</label><input type="text" id="straat" name="straat" placeholder="Straat" value="<?php echo htmlspecialchars($pandDetails['straat'] ?? ''); ?>" required></div>
                    <div><label for="nr">Nummer:</label><input type="text" id="nr" name="nr" placeholder="Nummer" value="<?php echo htmlspecialchars($pandDetails['nr'] ?? ''); ?>" required></div>
                    <div><label for="bus">Bus:</label><input type="text" id="bus" name="bus" placeholder="Bus" value="<?php echo htmlspecialchars($pandDetails['bus'] ?? ''); ?>"></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="adresOpAanvraag" name="adresOpAanvraag" value="1" <?php echo ($pandDetails['adresOpAanvraag'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="adresOpAanvraag" class="checkbox-label">Adres op aanvraag</label>
                    </div>

                    <!-- Wettelijke Informatie Fields -->
                    <div><label for="epcIndex">EPC Index:</label><input type="text" id="epcIndex" name="epcIndex" placeholder="EPC Index" value="<?php echo htmlspecialchars($pandDetails['epcIndex'] ?? ''); ?>" required></div>
                    <div><label for="energieLabel">Energie Label:</label><input type="text" id="energieLabel" name="energieLabel" placeholder="Energie Label" value="<?php echo htmlspecialchars($pandDetails['energieLabel'] ?? ''); ?>" required></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="stedenbouwkundigeVergunning" name="stedenbouwkundigeVergunning" value="1" <?php echo ($pandDetails['stedenbouwkundigeVergunning'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="stedenbouwkundigeVergunning" class="checkbox-label">Stedenbouwkundige Vergunning</label>
                    </div>
                    <div><label for="stedenbouwkundigeVergunningInfo">Extra info:</label><input type="text" id="stedenbouwkundigeVergunningInfo" name="stedenbouwkundigeVergunningInfo" placeholder="stedenbouwkundigeVergunningInfo" value="<?php echo htmlspecialchars($pandDetails['stedenbouwkundigeVergunningInfo'] ?? ''); ?>"></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="verkavelingsvergunning" name="verkavelingsvergunning" value="1" <?php echo ($pandDetails['verkavelingsvergunning'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="verkavelingsvergunning" class="checkbox-label">Verkavelingsvergunning</label>
                    </div>
                    <div><label for="verkavelingsvergunningInfo">Extra info:</label><input type="text" id="verkavelingsvergunningInfo" name="verkavelingsvergunningInfo" placeholder="verkavelingsvergunningInfo" value="<?php echo htmlspecialchars($pandDetails['verkavelingsvergunningInfo'] ?? ''); ?>"></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="voorkooprecht" name="voorkooprecht" value="1" <?php echo ($pandDetails['voorkooprecht'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="voorkooprecht" class="checkbox-label">Voorkooprecht</label>
                    </div>
                    <div><label for="voorkooprechtInfo">Extra info:</label><input type="text" id="voorkooprechtInfo" name="voorkooprechtInfo" placeholder="voorkooprechtInfo" value="<?php echo htmlspecialchars($pandDetails['voorkooprechtInfo'] ?? ''); ?>"></div>
                    <div><label for="stedenbouwkundigeBestemming">Stedenbouwkundige Bestemming:</label><input type="text" id="stedenbouwkundigeBestemming" name="stedenbouwkundigeBestemming" placeholder="Stedenbouwkundige Bestemming" value="<?php echo htmlspecialchars($pandDetails['stedenbouwkundigeBestemming'] ?? ''); ?>" required></div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="dagvaardingEnHerstelvordering" name="dagvaardingEnHerstelvordering" value="1" <?php echo ($pandDetails['dagvaardingEnHerstelvordering'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="dagvaardingEnHerstelvordering" class="checkbox-label">Dagvaarding en Herstelvordering</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="effectiefOverstromingsgevoelig" name="effectiefOverstromingsgevoelig" value="1" <?php echo ($pandDetails['effectiefOverstromingsgevoelig'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="effectiefOverstromingsgevoelig" class="checkbox-label">Effectief Overstromingsgevoelig</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="mogelijkOverstromingsgevoelig" name="mogelijkOverstromingsgevoelig" value="1" <?php echo ($pandDetails['mogelijkOverstromingsgevoelig'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="mogelijkOverstromingsgevoelig" class="checkbox-label">Mogelijk Overstromingsgevoelig</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="afgebakendOverstromingsgebied" name="afgebakendOverstromingsgebied" value="1" <?php echo ($pandDetails['afgebakendOverstromingsgebied'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="afgebakendOverstromingsgebied" class="checkbox-label">Afgebakend Overstromingsgebied</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="afgebakendeOeverzone" name="afgebakendeOeverzone" value="1" <?php echo ($pandDetails['afgebakendeOeverzone'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="afgebakendeOeverzone" class="checkbox-label">Afgebakende Oeverzone</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="risicozoneVoorOverstromingen" name="risicozoneVoorOverstromingen" value="1" <?php echo ($pandDetails['risicozoneVoorOverstromingen'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="risicozoneVoorOverstromingen" class="checkbox-label">Risicozone voor Overstromingen</label>
                    </div>

                    <div>
                        <label for="overstromingskansPerceel">Overstromingskans perceelscore:</label>
                        <select id="overstromingskansPerceel" name="overstromingskansPerceel" required>
                            <option value="A" <?php echo (isset($pandDetails['overstromingskansPerceel']) && $pandDetails['overstromingskansPerceel'] == 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?php echo (isset($pandDetails['overstromingskansPerceel']) && $pandDetails['overstromingskansPerceel'] == 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?php echo (isset($pandDetails['overstromingskansPerceel']) && $pandDetails['overstromingskansPerceel'] == 'C') ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?php echo (isset($pandDetails['overstromingskansPerceel']) && $pandDetails['overstromingskansPerceel'] == 'D') ? 'selected' : ''; ?>>D</option>
                        </select>
                    </div>

                    <div>
                        <label for="overstromingskansGebouw">Overstromingskans perceelscore:</label>
                        <select id="overstromingskansGebouw" name="overstromingskansGebouw" required>
                            <option value="A" <?php echo (isset($pandDetails['overstromingskansGebouw']) && $pandDetails['overstromingskansGebouw'] == 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?php echo (isset($pandDetails['overstromingskansGebouw']) && $pandDetails['overstromingskansGebouw'] == 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?php echo (isset($pandDetails['overstromingskansGebouw']) && $pandDetails['overstromingskansGebouw'] == 'C') ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?php echo (isset($pandDetails['overstromingskansGebouw']) && $pandDetails['overstromingskansGebouw'] == 'D') ? 'selected' : ''; ?>>D</option>
                        </select>
                    </div>

                    <div class="checkbox-container">
                        <input type="checkbox" id="erfgoed" name="erfgoed" value="1" <?php echo ($pandDetails['erfgoed'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="erfgoed" class="checkbox-label">Erfgoed</label>
                    </div>
                    <div><label for="erfgoedInfo">Extra info:</label><input type="text" id="erfgoedInfo" name="erfgoedInfo" placeholder="erfgoedInfo" value="<?php echo htmlspecialchars($pandDetails['erfgoedInfo'] ?? ''); ?>"></div>

                    <!-- Panddetails fields -->
                    <div class="checkbox-container">
                        <input type="checkbox" id="isNieuw" name="isNieuw" value="1" <?php echo ($pandDetails['isNieuw'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="isNieuw" class="checkbox-label">Is Nieuw</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="isOpbrengsteigendom" name="isOpbrengsteigendom" value="1" <?php echo ($pandDetails['isOpbrengsteigendom'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="isOpbrengsteigendom" class="checkbox-label">Is Opbrengsteigendom</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="isExclusiefVastgoed" name="isExclusiefVastgoed" value="1" <?php echo ($pandDetails['isExclusiefVastgoed'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="isExclusiefVastgoed" class="checkbox-label">Is Exclusief Vastgoed</label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="isBeleggingsvastgoed" name="isBeleggingsvastgoed" value="1" <?php echo ($pandDetails['isBeleggingsvastgoed'] ?? 0) ? 'checked' : ''; ?>>
                        <label for="isBeleggingsvastgoed" class="checkbox-label">Is Beleggingsvastgoed</label>
                    </div>

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
                                            <div><label for="kamerOppervlakte<?php echo $room['kamerID']; ?>">Kamer Oppervlakte:</label><input type="number" id="kamerOppervlakte<?php echo $room['kamerID']; ?>" name="kamerOppervlakte[]" value="<?php echo htmlspecialchars($room['kamerOppervlakte']); ?>"></div>
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