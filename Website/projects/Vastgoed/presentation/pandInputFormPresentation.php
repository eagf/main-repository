<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/pandInput.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <title>Toevoegen</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <?php if (isset($message)) { 
        echo "<p class='success'>".$message."</p>";
     } ?>

    <form action="pandDelete.php" method="POST">
        <button type="submit">Pand verwijderen</button>
    </form>

    <h2>Nieuw Pand Toevoegen</h2>
    <form action="data/pandInputBackend.php" method="POST">

        <!-- Fields for panden table -->
        <div><label for="titel">Titel:</label><input type="text" id="titel" name="titel" value="test" required></div>
        <div><label for="tekst">Beschrijving:</label><textarea id="tekst" name="tekst" value="test" required></textarea></div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Te koop">Te koop</option>
                <option value="Te huur">Te huur</option>
            </select>
        </div>
        <div><label for="type">Type:</label><input type="text" id="type" name="type" value="test" required></div>
        <div><label for="subtype">Subtype:</label><input type="text" id="subtype" name="subtype" value="test" required></div>
        <div><label for="aanvullingSubtype">Aanvulling Subtype:</label><input type="text" id="aanvullingSubtype" name="aanvullingSubtype" value="test" required></div>
        <div><label for="bouwjaar">Bouwjaar:</label><input type="number" id="bouwjaar" name="bouwjaar" value="1992" required></div>
        <div><label for="brutoVloeroppervlakte">Bruto Vloeroppervlakte:</label><input type="number" step="0.01" id="brutoVloeroppervlakte" name="brutoVloeroppervlakte" value="87" required></div>
        <div><label for="grondoppervlakte">Grondoppervlakte:</label><input type="number" step="0.01" id="grondoppervlakte" name="grondoppervlakte" value="102" required></div>
        <div><label for="aantalSlaapkamers">Aantal Slaapkamers:</label><input type="number" id="aantalSlaapkamers" name="aantalSlaapkamers" value="3" required></div>
        <div><label for="prijs">Prijs:</label><input type="number" step="0.01" id="prijs" name="prijs" value="300000" required></div>
        <div><label for="kadastraalInkomen">Kadastraal Inkomen:</label><input type="number" step="0.01" id="kadastraalInkomen" name="kadastraalInkomen" value="15000" required></div>
        <div>
            <label for="registratierechtenBTW">Registratierechten of BTW:</label>
            <select id="registratierechtenBTW" name="registratierechtenBTW" required>
                <option value="21%">21%</option>
                <option value="6%">6%</option>
                <option value="Registratierechten">Registratierechten</option>
            </select>
        </div>
        <div><label for="vrijOp">Vrij Op:</label><input type="date" id="vrijOp" name="vrijOp" value="13/08/2024" required></div>

        <!-- Fields for kamers table -->
        <div><label for="kamerNaam">Kamer Naam:</label><input type="text" id="kamerNaam" name="kamerNaam[]" value="test" required></div>
        <div><label for="kamerOppervlakte">Kamer Oppervlakte:</label><input type="number" step="0.01" id="kamerOppervlakte" name="kamerOppervlakte[]" value="12" required></div>
        <div><label for="kamerDetail">Kamer Detail:</label><textarea id="kamerDetail" name="kamerDetail[]" value="test"></textarea></div>

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
        <div><label for="stedenbouwkundigeVergunning">Stedenbouwkundige Vergunning:</label><input type="checkbox" id="stedenbouwkundigeVergunning" name="stedenbouwkundigeVergunning" value="1"></div>
        <div><label for="verkavelingsvergunning">Verkavelingsvergunning:</label><input type="checkbox" id="verkavelingsvergunning" name="verkavelingsvergunning" value="1"></div>
        <div><label for="voorkooprecht">Voorkooprecht:</label><input type="checkbox" id="voorkooprecht" name="voorkooprecht" value="1"></div>
        <div><label for="stedenbouwkundigeBestemming">Stedenbouwkundige Bestemming:</label><input type="text" id="stedenbouwkundigeBestemming" name="stedenbouwkundigeBestemming" value="test" required></div>
        <div><label for="dagvaardingEnHerstelvordering">Dagvaarding en Herstelvordering:</label><input type="checkbox" id="dagvaardingEnHerstelvordering" name="dagvaardingEnHerstelvordering" value="1"></div>
        <div><label for="effectiefOverstromingsgevoelig">Effectief Overstromingsgevoelig:</label><input type="checkbox" id="effectiefOverstromingsgevoelig" name="effectiefOverstromingsgevoelig" value="1"></div>
        <div><label for="mogelijkOverstromingsgevoelig">Mogelijk Overstromingsgevoelig:</label><input type="checkbox" id="mogelijkOverstromingsgevoelig" name="mogelijkOverstromingsgevoelig" value="1"></div>
        <div><label for="afgebakendOverstromingsgebied">Afgebakend Overstromingsgebied:</label><input type="checkbox" id="afgebakendOverstromingsgebied" name="afgebakendOverstromingsgebied" value="1"></div>
        <div><label for="afgebakendeOeverzone">Afgebakende Oeverzone:</label><input type="checkbox" id="afgebakendeOeverzone" name="afgebakendeOeverzone" value="1"></div>
        <div><label for="risicozoneVoorOverstromingen">Risicozone voor Overstromingen:</label><input type="checkbox" id="risicozoneVoorOverstromingen" name="risicozoneVoorOverstromingen" value="1"></div>
        <div><label for="overstromingskansPerceel">Overstromingskans Perceel (P-score):</label><input type="number" step="0.01" id="overstromingskansPerceel" name="overstromingskansPerceel" value="45"></div>
        <div><label for="overstromingskansGebouw">Overstromingskans Gebouw (G-score):</label><input type="number" step="0.01" id="overstromingskansGebouw" name="overstromingskansGebouw" value="28"></div>
        <div><label for="erfgoed">Erfgoed:</label><input type="checkbox" id="erfgoed" name="erfgoed" value="1"></div>

        <!-- Fields for panddetails table -->
        <div>
            <label for="isNieuw">Is Nieuw:</label>
            <input type="checkbox" id="isNieuw" name="isNieuw" value="1">
        </div>
        <div>
            <label for="isOpbrengsteigendom">Is Opbrengsteigendom:</label>
            <input type="checkbox" id="isOpbrengsteigendom" name="isOpbrengsteigendom" value="1">
        </div>
        <div>
            <label for="isExclusiefVastgoed">Is Exclusief Vastgoed:</label>
            <input type="checkbox" id="isExclusiefVastgoed" name="isExclusiefVastgoed" value="1">
        </div>
        <div>
            <label for="isBeleggingsvastgoed">Is Beleggingsvastgoed:</label>
            <input type="checkbox" id="isBeleggingsvastgoed" name="isBeleggingsvastgoed" value="1">
        </div>

        <!-- Add submit button -->
        <div><button type="submit" name="submit">Pand Toevoegen</button></div>
    </form>
</body>

</html>