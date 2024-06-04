<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <title>Toevoegen</title>
    <script src="scripts/pandInput.js" defer></script>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="back-to-admin">
            <a href="admin.php" class="back-button">Back to Admin Page</a>
        </div>

        <?php if (isset($message)) {
            echo "<p class='success'>" . $message . "</p>";
        } ?>

        <div class="form-container">

            <h2>Nieuw Pand Toevoegen</h2>
            <form action="data/pandInputBackend.php" method="POST">

                <!-- Fields for panden table -->
                <div><label for="titel">Titel:</label><input type="text" id="titel" name="titel" value="test" required></div>
                <div><label for="tekst">Beschrijving:</label><textarea id="tekst" name="tekst" required>test</textarea></div>
                <div>
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="Te koop">Te koop</option>
                        <option value="Te huur">Te huur</option>
                    </select>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="homepage" name="homepage" value="1">
                    <label for="homepage" class="checkbox-label">Op homepage</label>
                </div>
                <div><label for="type">Type:</label><input type="text" id="type" name="type" value="type" required></div>
                <div><label for="subtype">Subtype:</label><input type="text" id="subtype" name="subtype"></div>
                <div><label for="aanvullingSubtype">Aanvulling Subtype:</label><input type="text" id="aanvullingSubtype" name="aanvullingSubtype"></div>
                <div><label for="bouwjaar">Bouwjaar:</label><input type="number" id="bouwjaar" name="bouwjaar" value="1992"></div>
                <div><label for="brutoVloeroppervlakte">Bruto Vloeroppervlakte:</label><input type="number" step="0.01" id="brutoVloeroppervlakte" name="brutoVloeroppervlakte" value="87"></div>
                <div><label for="grondoppervlakte">Grondoppervlakte:</label><input type="number" step="0.01" id="grondoppervlakte" name="grondoppervlakte" value="102"></div>
                <div><label for="aantalSlaapkamers">Aantal Slaapkamers:</label><input type="number" id="aantalSlaapkamers" name="aantalSlaapkamers" value="3"></div>
                <div><label for="prijs">Prijs:</label><input type="number" step="0.01" id="prijs" name="prijs" value="300000" required></div>
                <div><label for="kadastraalInkomen">Kadastraal Inkomen:</label><input type="number" step="0.01" id="kadastraalInkomen" name="kadastraalInkomen" value="15000"></div>
                <div><label for="bezoekOp">Bezoek op:</label><input type="text" id="bezoekOp" name="bezoekOp" value="bezoek op" required></div>

                <div>
                    <label for="vrijOp">Vrij op:</label>
                    <select id="vrijOp" name="vrijOp" onchange="handleVrijOpChange()">
                        <option value="Onmiddelijk">Onmiddelijk</option>
                        <option value="Bij akte">Bij akte</option>
                        <option value="Na opzeg huurcontract">Na opzeg huurcontract</option>
                        <option value="date">Datum</option>
                    </select>
                </div>

                <div id="dateFieldContainer" style="display:none;">
                    <label for="specificDate">Specifieke datum:</label>
                    <input type="date" id="specificDate" name="specificDate" onchange="updateVrijOp()">
                </div>

                <div id="kamersForm">
                    <div id="kamerFields">
                        <!-- Fields for the first "kamer" -->
                        <div><label for="kamerNaam">Kamer Naam:</label><input type="text" id="kamerNaam" name="kamerNaam[]" value="test" required></div>
                        <div><label for="kamerOppervlakte">Kamer Oppervlakte:</label><input type="number" step="0.01" id="kamerOppervlakte" name="kamerOppervlakte[]"></div>
                        <div><label for="kamerDetail">Kamer Detail:</label><textarea id="kamerDetail" name="kamerDetail[]">test: kamer details</textarea></div>
                    </div>
                </div>
                <!-- Plus button to add more "kamer" fields -->
                <button type="button" id="addKamer">Add Kamer</button>

                <!-- Fields for adressen table -->
                <div><label for="land">Land:</label><input type="text" id="land" name="land" value="test" required></div>
                <div><label for="postcode">Postcode:</label><input type="text" id="postcode" name="postcode" value="test" required></div>
                <div><label for="gemeente">Gemeente:</label><input type="text" id="gemeente" name="gemeente" value="test" required></div>
                <div><label for="straat">Straat:</label><input type="text" id="straat" name="straat" value="test" required></div>
                <div><label for="nr">Nummer:</label><input type="text" id="nr" name="nr" value="test" required></div>
                <div><label for="bus">Bus:</label><input type="text" id="bus" name="bus" value="test"></div> <!-- Bus is optional -->
                <div>
                    <label for="adresOpAanvraag">Adres op Aanvraag:</label>
                    <select id="adresOpAanvraag" name="adresOpAanvraag" required>
                        <option value="0">Nee</option>
                        <option value="1">Ja</option>
                    </select>
                </div>

                <!-- Fields for wettelijkeinformatie table -->
                <div><label for="epcIndex">EPC Index:</label><input type="number" step="0.01" id="epcIndex" name="epcIndex" value="120" required></div>
                <div>
                    <label for="energieLabel">Energie Label:</label>
                    <select id="energieLabel" name="energieLabel" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                    </select>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="renovatieverplichting" name="renovatieverplichting" value="1">
                    <label for="renovatieverplichting" class="checkbox-label">Renovatieverplichting</label>
                </div>
                <div>
                    <label for="stedenbouwkundigeVergunning">Stedenbouwkundige Vergunning</label>
                    <select id="stedenbouwkundigeVergunning" name="stedenbouwkundigeVergunning" required>
                        <option value="Vergund">Vergund</option>
                        <option value="Niet vergund">Niet vergund</option>
                    </select>
                </div>
                <div><label for="stedenbouwkundigeVergunningInfo">Extra info:</label><input type="text" id="stedenbouwkundigeVergunningInfo" name="stedenbouwkundigeVergunningInfo"></div>
                <div class="checkbox-container">
                    <input type="checkbox" id="verkavelingsvergunning" name="verkavelingsvergunning" value="1">
                    <label for="verkavelingsvergunning" class="checkbox-label">Verkavelingsvergunning</label>
                </div>
                <div><label for="verkavelingsvergunningInfo">Extra info:</label><input type="text" id="verkavelingsvergunningInfo" name="verkavelingsvergunningInfo"></div>
                <div class="checkbox-container">
                    <input type="checkbox" id="voorkooprecht" name="voorkooprecht" value="1">
                    <label for="voorkooprecht" class="checkbox-label">Voorkooprecht</label>
                </div>
                <div><label for="voorkooprechtInfo">Extra info:</label><input type="text" id="voorkooprechtInfo" name="voorkooprechtInfo"></div>
                <div><label for="stedenbouwkundigeBestemming">Stedenbouwkundige Bestemming:</label><input type="text" id="stedenbouwkundigeBestemming" name="stedenbouwkundigeBestemming" value="test" required></div>
                <div class="checkbox-container">
                    <input type="checkbox" id="dagvaardingEnHerstelvordering" name="dagvaardingEnHerstelvordering" value="1">
                    <label for="dagvaardingEnHerstelvordering" class="checkbox-label">Dagvaarding en Herstelvordering</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="effectiefOverstromingsgevoelig" name="effectiefOverstromingsgevoelig" value="1">
                    <label for="effectiefOverstromingsgevoelig" class="checkbox-label">Effectief Overstromingsgevoelig</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="mogelijkOverstromingsgevoelig" name="mogelijkOverstromingsgevoelig" value="1">
                    <label for="mogelijkOverstromingsgevoelig" class="checkbox-label">Mogelijk Overstromingsgevoelig</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="afgebakendOverstromingsgebied" name="afgebakendOverstromingsgebied" value="1">
                    <label for="afgebakendOverstromingsgebied" class="checkbox-label">Afgebakend Overstromingsgebied</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="afgebakendeOeverzone" name="afgebakendeOeverzone" value="1">
                    <label for="afgebakendeOeverzone" class="checkbox-label">Afgebakende Oeverzone</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="risicozoneVoorOverstromingen" name="risicozoneVoorOverstromingen" value="1">
                    <label for="risicozoneVoorOverstromingen" class="checkbox-label">Risicozone voor Overstromingen</label>
                </div>

                <div>
                    <label for="overstromingskansPerceel">Overstromingskans perceelscore:</label>
                    <select id="overstromingskansPerceel" name="overstromingskansPerceel" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="Niet van toepassing">Niet van toepassing</option>
                    </select>
                </div>
                <div>
                    <label for="overstromingskansGebouw">Overstromingskans gebouwscore:</label>
                    <select id="overstromingskansGebouw" name="overstromingskansGebouw" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="Niet van toepassing">Niet van toepassing</option>
                    </select>
                </div>

                <div class="checkbox-container">
                    <input type="checkbox" id="erfgoed" name="erfgoed" value="1">
                    <label for="erfgoed" class="checkbox-label">Erfgoed</label>
                </div>
                <div><label for="erfgoedInfo">Extra info:</label><input type="text" id="erfgoedInfo" name="erfgoedInfo"></div>

                <!-- Fields for panddetails table -->
                <div class="checkbox-container">
                    <input type="checkbox" id="isNieuw" name="isNieuw" value="1">
                    <label for="isNieuw" class="checkbox-label">Is Nieuw</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="isOpbrengsteigendom" name="isOpbrengsteigendom" value="1">
                    <label for="isOpbrengsteigendom" class="checkbox-label">Is Opbrengsteigendom</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="isExclusiefVastgoed" name="isExclusiefVastgoed" value="1">
                    <label for="isExclusiefVastgoed" class="checkbox-label">Is Exclusief Vastgoed</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="isBeleggingsvastgoed" name="isBeleggingsvastgoed" value="1">
                    <label for="isBeleggingsvastgoed" class="checkbox-label">Is Beleggingsvastgoed</label>
                </div>

                <!-- Add submit button -->
                <div><button type="submit" name="submit">Pand Toevoegen</button></div>
            </form>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>