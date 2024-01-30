<?php
require_once 'DBConfig.php';

if (isset($_POST['submit'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $db->beginTransaction();

        // Prepare an INSERT statement for adressen
        $queryAdressen = "INSERT INTO adressen (land, postcode, gemeente, straat, nr, bus, adresOpAanvraag)
        VALUES (:land, :postcode, :gemeente, :straat, :nr, :bus, :adresOpAanvraag)";
        $stmtAdressen = $db->prepare($queryAdressen);

        // Bind parameters for adressen
        $stmtAdressen->bindParam(':land', $_POST['land']);
        $stmtAdressen->bindParam(':postcode', $_POST['postcode']);
        $stmtAdressen->bindParam(':gemeente', $_POST['gemeente']);
        $stmtAdressen->bindParam(':straat', $_POST['straat']);
        $stmtAdressen->bindParam(':nr', $_POST['nr']);
        $stmtAdressen->bindParam(':bus', $_POST['bus']);
        $stmtAdressen->bindParam(':adresOpAanvraag', $_POST['adresOpAanvraag'], PDO::PARAM_INT);

        // Execute the query for adressen
        $stmtAdressen->execute();
        $adresID = $db->lastInsertId();


        // Prepare an INSERT statement for wettelijkeinformatie
        $queryWettelijkeInfo = "INSERT INTO wettelijkeinformatie (
    epcIndex, energieLabel, stedenbouwkundigeVergunning, verkavelingsvergunning, 
    voorkooprecht, stedenbouwkundigeBestemming, dagvaardingEnHerstelvordering, 
    effectiefOverstromingsgevoelig, mogelijkOverstromingsgevoelig, afgebakendOverstromingsgebied, 
    afgebakendeOeverzone, risicozoneVoorOverstromingen, overstromingskansPerceel, 
    overstromingskansGebouw, erfgoed
) VALUES (
    :epcIndex, :energieLabel, :stedenbouwkundigeVergunning, :verkavelingsvergunning, 
    :voorkooprecht, :stedenbouwkundigeBestemming, :dagvaardingEnHerstelvordering, 
    :effectiefOverstromingsgevoelig, :mogelijkOverstromingsgevoelig, :afgebakendOverstromingsgebied, 
    :afgebakendeOeverzone, :risicozoneVoorOverstromingen, :overstromingskansPerceel, 
    :overstromingskansGebouw, :erfgoed
)";
        $stmtWettelijkeInfo = $db->prepare($queryWettelijkeInfo);

        // Bind parameters for wettelijkeinformatie
        $stmtWettelijkeInfo->bindParam(':epcIndex', $_POST['epcIndex']);
        $stmtWettelijkeInfo->bindParam(':energieLabel', $_POST['energieLabel']);
        $stmtWettelijkeInfo->bindParam(':stedenbouwkundigeVergunning', $_POST['stedenbouwkundigeVergunning'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':verkavelingsvergunning', $_POST['verkavelingsvergunning'], PDO::PARAM_INT);
        $stmtWettelijkeInfo->bindParam(':voorkooprecht', $_POST['voorkooprecht'], PDO::PARAM_INT);
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

        // Execute the query for wettelijkeinformatie
        $stmtWettelijkeInfo->execute();
        $wettelijkeInfoID = $db->lastInsertId();

        // Insert into panddetails table
        $queryPandDetails = "INSERT INTO panddetails (
    isNieuw, isOpbrengsteigendom, isExclusiefVastgoed, isBeleggingsvastgoed
) 
VALUES (
    :isNieuw, :isOpbrengsteigendom, :isExclusiefVastgoed, :isBeleggingsvastgoed
)";
        $stmtPandDetails = $db->prepare($queryPandDetails);

        $isNieuw = isset($_POST['isNieuw']) ? 1 : 0;
        $isOpbrengsteigendom = isset($_POST['isOpbrengsteigendom']) ? 1 : 0;
        $isExclusiefVastgoed = isset($_POST['isExclusiefVastgoed']) ? 1 : 0;
        $isBeleggingsvastgoed = isset($_POST['isBeleggingsvastgoed']) ? 1 : 0;

        // Later in your SQL statement binding
        $stmtPandDetails->bindParam(':isNieuw', $isNieuw, PDO::PARAM_INT);
        $stmtPandDetails->bindParam(':isOpbrengsteigendom', $isOpbrengsteigendom, PDO::PARAM_INT);
        $stmtPandDetails->bindParam(':isExclusiefVastgoed', $isExclusiefVastgoed, PDO::PARAM_INT);
        $stmtPandDetails->bindParam(':isBeleggingsvastgoed', $isBeleggingsvastgoed, PDO::PARAM_INT);

        // Execute the query for panddetails
        $stmtPandDetails->execute();
        $pandDetailID = $db->lastInsertId();

        // Insert into panden table
        $queryPanden = "INSERT INTO panden (
    titel, tekst, status, type, subtype, aanvullingSubtype, bouwjaar, brutoVloeroppervlakte,
    grondoppervlakte, aantalSlaapkamers, prijs, kadastraalInkomen, registratierechtenBTW,
    vrijOp, adresID, pandDetailID, wettelijkeInfoID
    ) 
    VALUES 
    (
    :titel, :tekst, :status, :type, :subtype, :aanvullingSubtype, :bouwjaar, :brutoVloeroppervlakte,
    :grondoppervlakte, :aantalSlaapkamers, :prijs, :kadastraalInkomen, :registratierechtenBTW,
    :vrijOp, :adresID, :pandDetailID, :wettelijkeInfoID
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
        $stmtPanden->bindParam(':registratierechtenBTW', $_POST['registratierechtenBTW']);
        $stmtPanden->bindParam(':vrijOp', $_POST['vrijOp']);
        $stmtPanden->bindParam(':adresID', $adresID, PDO::PARAM_INT);
        $stmtPanden->bindParam(':pandDetailID', $pandDetailID, PDO::PARAM_INT);
        $stmtPanden->bindParam(':wettelijkeInfoID', $wettelijkeInfoID, PDO::PARAM_INT);

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
