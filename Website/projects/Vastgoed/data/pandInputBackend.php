<?php
require_once 'DBConfig.php';

if (isset($_POST['submit'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $db->beginTransaction();

        // Prepare an INSERT statement for adressen
        $queryAdressen = "INSERT INTO adressen (
        land, postcode, gemeente, straat, nr, bus, adresOpAanvraag
        )
        VALUES (
        :land, :postcode, :gemeente, :straat, :nr, :bus, :adresOpAanvraag
        )";
        $stmtAdressen = $db->prepare($queryAdressen);

        // Bind parameters for adressen
        $stmtAdressen->bindParam(':land', $_POST['land']);
        $stmtAdressen->bindParam(':postcode', $_POST['postcode']);
        $stmtAdressen->bindParam(':gemeente', $_POST['gemeente']);
        $stmtAdressen->bindParam(':straat', $_POST['straat']);
        $stmtAdressen->bindParam(':nr', $_POST['nr']);
        $stmtAdressen->bindParam(':bus', $_POST['bus']);
        $stmtAdressen->bindParam(':adresOpAanvraag', $_POST['adresOpAanvraag'], PDO::PARAM_INT);

        $stmtAdressen->execute();
        $adresID = $db->lastInsertId();

        // Prepare an INSERT statement for wettelijkeinformatie
        $queryWettelijkeInfo = "INSERT INTO wettelijkeinformatie (
        epcIndex, energieLabel, stedenbouwkundigeVergunning, stedenbouwkundigeVergunningInfo, verkavelingsvergunning, verkavelingsvergunningInfo,
        voorkooprecht, voorkooprechtInfo, stedenbouwkundigeBestemming, dagvaardingEnHerstelvordering, 
        effectiefOverstromingsgevoelig, mogelijkOverstromingsgevoelig, afgebakendOverstromingsgebied, 
        afgebakendeOeverzone, risicozoneVoorOverstromingen, overstromingskansPerceel, 
        overstromingskansGebouw, erfgoed, erfgoedInfo, renovatieverplichting
        ) 
        VALUES (
        :epcIndex, :energieLabel, :stedenbouwkundigeVergunning, :stedenbouwkundigeVergunningInfo, :verkavelingsvergunning, :verkavelingsvergunningInfo, 
        :voorkooprecht, :voorkooprechtInfo, :stedenbouwkundigeBestemming, :dagvaardingEnHerstelvordering, 
        :effectiefOverstromingsgevoelig, :mogelijkOverstromingsgevoelig, :afgebakendOverstromingsgebied, 
        :afgebakendeOeverzone, :risicozoneVoorOverstromingen, :overstromingskansPerceel, 
        :overstromingskansGebouw, :erfgoed, :erfgoedInfo, :renovatieverplichting
        )";

        $stmtWettelijkeInfo = $db->prepare($queryWettelijkeInfo);

        // Bind parameters for wettelijkeinformatie
        $stmtWettelijkeInfo->bindParam(':epcIndex', $_POST['epcIndex']);
        $stmtWettelijkeInfo->bindParam(':energieLabel', $_POST['energieLabel']);
        $stmtWettelijkeInfo->bindParam(':stedenbouwkundigeVergunning', $_POST['stedenbouwkundigeVergunning']);
        $stmtWettelijkeInfo->bindParam(':stedenbouwkundigeVergunningInfo', $_POST['stedenbouwkundigeVergunningInfo']);
        $stmtWettelijkeInfo->bindParam(':verkavelingsvergunning', $_POST['verkavelingsvergunning'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':verkavelingsvergunningInfo', $_POST['verkavelingsvergunningInfo']);
        $stmtWettelijkeInfo->bindParam(':voorkooprecht', $_POST['voorkooprecht'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':voorkooprechtInfo', $_POST['voorkooprechtInfo']);
        $stmtWettelijkeInfo->bindParam(':stedenbouwkundigeBestemming', $_POST['stedenbouwkundigeBestemming']);
        $stmtWettelijkeInfo->bindParam(':dagvaardingEnHerstelvordering', $_POST['dagvaardingEnHerstelvordering'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':effectiefOverstromingsgevoelig', $_POST['effectiefOverstromingsgevoelig'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':mogelijkOverstromingsgevoelig', $_POST['mogelijkOverstromingsgevoelig'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':afgebakendOverstromingsgebied', $_POST['afgebakendOverstromingsgebied'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':afgebakendeOeverzone', $_POST['afgebakendeOeverzone'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':risicozoneVoorOverstromingen', $_POST['risicozoneVoorOverstromingen'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':overstromingskansPerceel', $_POST['overstromingskansPerceel']);
        $stmtWettelijkeInfo->bindParam(':overstromingskansGebouw', $_POST['overstromingskansGebouw']);
        $stmtWettelijkeInfo->bindParam(':erfgoed', $_POST['erfgoed'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':erfgoedInfo', $_POST['erfgoedInfo']);
        $stmtWettelijkeInfo->bindParam(':renovatieverplichting', $_POST['renovatieverplichting'], PDO::PARAM_INT);

        $stmtWettelijkeInfo->execute();
        $wettelijkeInfoID = $db->lastInsertId();

        // Insert into panden table
        $queryPanden = "INSERT INTO panden (
            titel, tekst, status, type, subtype, aanvullingSubtype, bouwjaar, 
            brutoVloeroppervlakte, grondoppervlakte, aantalSlaapkamers, prijs, 
            kadastraalInkomen, bezoekOp, vrijOp, homepage, adresID, wettelijkeInfoID,
            isNieuw, isVerkochtVerhuurd, isOpbrengsteigendom, isExclusiefVastgoed, isBeleggingsvastgoed
        ) VALUES (
            :titel, :tekst, :status, :type, :subtype, :aanvullingSubtype, :bouwjaar,
            :brutoVloeroppervlakte, :grondoppervlakte, :aantalSlaapkamers, :prijs,
            :kadastraalInkomen, :bezoekOp, :vrijOp, :homepage, :adresID, 
            :wettelijkeInfoID, :isNieuw, :isVerkochtVerhuurd, :isOpbrengsteigendom, :isExclusiefVastgoed, 
            :isBeleggingsvastgoed
        )";

        $stmtPanden = $db->prepare($queryPanden);

        // Bind parameters for panden
        $stmtPanden->bindParam(':titel', $_POST['titel']);
        $stmtPanden->bindParam(':tekst', $_POST['tekst']);
        $stmtPanden->bindParam(':status', $_POST['status']);
        $stmtPanden->bindParam(':type', $_POST['type']);
        $stmtPanden->bindParam(':subtype', $_POST['subtype']);
        $stmtPanden->bindParam(':aanvullingSubtype', $_POST['aanvullingSubtype']);
        $stmtPanden->bindParam(':bouwjaar', $_POST['bouwjaar']);
        $stmtPanden->bindParam(':brutoVloeroppervlakte', $_POST['brutoVloeroppervlakte']);
        $stmtPanden->bindParam(':grondoppervlakte', $_POST['grondoppervlakte']);
        $stmtPanden->bindParam(':aantalSlaapkamers', $_POST['aantalSlaapkamers']);
        $stmtPanden->bindParam(':prijs', $_POST['prijs']);
        $stmtPanden->bindParam(':kadastraalInkomen', $_POST['kadastraalInkomen']);
        $stmtPanden->bindParam(':bezoekOp', $_POST['bezoekOp']);
        if (!empty($_POST['vrijOp']) && $_POST['vrijOp'] != 'date') {
            $stmtPanden->bindParam(':vrijOp', $_POST['vrijOp']);
        } 
        else {
            $stmtPanden->bindParam(':vrijOp', $_POST['specificDate']);
        }
        $stmtPanden->bindParam(':homepage', $_POST['homepage']);
        $stmtPanden->bindParam(':adresID', $adresID, PDO::PARAM_INT);
        $stmtPanden->bindParam(':wettelijkeInfoID', $wettelijkeInfoID, PDO::PARAM_INT);
        $stmtPanden->bindParam(':isNieuw', $_POST['isNieuw']);
        $stmtPanden->bindParam(':isVerkochtVerhuurd', $_POST['isVerkochtVerhuurd']);
        $stmtPanden->bindParam(':isOpbrengsteigendom', $_POST['isOpbrengsteigendom']);
        $stmtPanden->bindParam(':isExclusiefVastgoed', $_POST['isExclusiefVastgoed']);
        $stmtPanden->bindParam(':isBeleggingsvastgoed', $_POST['isBeleggingsvastgoed']);

        $stmtPanden->execute();
        $pandID = $db->lastInsertId();

        // Bind parameters for kamers
        if (isset($_POST['kamerNaam']) && is_array($_POST['kamerNaam'])) {
            for ($i = 0; $i < count($_POST['kamerNaam']); $i++) {
                $queryKamers = "INSERT INTO kamers (pandID, kamerNaam, kamerOppervlakte, kamerDetail) 
                        VALUES (:pandID, :kamerNaam, :kamerOppervlakte, :kamerDetail)";
                $stmtKamers = $db->prepare($queryKamers);
                $stmtKamers->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtKamers->bindParam(':kamerNaam', $_POST['kamerNaam'][$i]);
                $stmtKamers->bindParam(':kamerOppervlakte', $_POST['kamerOppervlakte'][$i]);
                $stmtKamers->bindParam(':kamerDetail', $_POST['kamerDetail'][$i]);
                $stmtKamers->execute();
            }
        }

        // Commit transaction
        $db->commit();

        header("Location: ../pandInput.php?message=added");
    } catch (PDOException $exception) {
        // Rollback transaction if any error occurs
        $db->rollBack();
        exit("Error: " . $exception->getMessage());
    }
}
