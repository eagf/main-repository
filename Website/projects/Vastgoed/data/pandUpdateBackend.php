<?php
require_once 'DBConfig.php';

if (isset($_POST['submit'])) {
    try {
                // CONTROL STILL IN CODE!!!!!!!!!!!!!!!!
        if ($_POST['pandID'] > 5) {
            $database = new Database();
            $db = $database->getConnection();

            $db->beginTransaction();

            // ================== adressen ==================

            // Prepare an UPDATE statement for adressen
            $queryAdressen = "UPDATE adressen SET 
            land = :land, 
            postcode = :postcode, 
            gemeente = :gemeente, 
            straat = :straat, 
            nr = :nr, 
            bus = :bus, 
            adresOpAanvraag = :adresOpAanvraag 
            WHERE adresID = (SELECT adresID FROM panden WHERE pandID = :pandID)";

            $stmtAdressen = $db->prepare($queryAdressen);

            // Bind parameters for adressen
            $stmtAdressen->bindParam(':land', $_POST['land']);
            $stmtAdressen->bindParam(':postcode', $_POST['postcode']);
            $stmtAdressen->bindParam(':gemeente', $_POST['gemeente']);
            $stmtAdressen->bindParam(':straat', $_POST['straat']);
            $stmtAdressen->bindParam(':nr', $_POST['nr']);
            $stmtAdressen->bindParam(':bus', $_POST['bus']);
            $stmtAdressen->bindParam(':adresOpAanvraag', $_POST['adresOpAanvraag'], PDO::PARAM_INT);
            $stmtAdressen->bindParam(':pandID', $_POST['pandID'], PDO::PARAM_INT);

            // Execute the query for adressen
            $stmtAdressen->execute();

            // ================== wettelijke informatie ==================

            // Updating wettelijkeinformatie
            $queryUpdateWettelijkeInfo = "UPDATE wettelijkeinformatie SET
            epcIndex = :epcIndex,
            energieLabel = :energieLabel,
            stedenbouwkundigeVergunning = :stedenbouwkundigeVergunning,
            stedenbouwkundigeVergunningInfo = :stedenbouwkundigeVergunningInfo,
            verkavelingsvergunning = :verkavelingsvergunning,
            verkavelingsvergunningInfo = :verkavelingsvergunningInfo,
            voorkooprecht = :voorkooprecht,
            voorkooprechtInfo = :voorkooprechtInfo,
            stedenbouwkundigeBestemming = :stedenbouwkundigeBestemming,
            dagvaardingEnHerstelvordering = :dagvaardingEnHerstelvordering,
            effectiefOverstromingsgevoelig = :effectiefOverstromingsgevoelig,
            mogelijkOverstromingsgevoelig = :mogelijkOverstromingsgevoelig,
            afgebakendOverstromingsgebied = :afgebakendOverstromingsgebied,
            afgebakendeOeverzone = :afgebakendeOeverzone,
            risicozoneVoorOverstromingen = :risicozoneVoorOverstromingen,
            overstromingskansPerceel = :overstromingskansPerceel,
            overstromingskansGebouw = :overstromingskansGebouw,
            erfgoed = :erfgoed,
            erfgoedInfo = :erfgoedInfo,
            renovatieverplichting = :renovatieverplichting
            WHERE wettelijkeInfoID = (SELECT wettelijkeInfoID FROM panden WHERE pandID = :pandID)";

            $stmtUpdateWettelijkeInfo = $db->prepare($queryUpdateWettelijkeInfo);

            // Bind parameters for wettelijkeinformatie
            $stmtUpdateWettelijkeInfo->bindParam(':epcIndex', $_POST['epcIndex']);
            $stmtUpdateWettelijkeInfo->bindParam(':energieLabel', $_POST['energieLabel']);
            $stmtUpdateWettelijkeInfo->bindParam(':stedenbouwkundigeVergunning', $_POST['stedenbouwkundigeVergunning']);
            $stmtUpdateWettelijkeInfo->bindParam(':stedenbouwkundigeVergunningInfo', $_POST['stedenbouwkundigeVergunningInfo']);
            $verkavelingsvergunning = isset($_POST['verkavelingsvergunning']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':verkavelingsvergunning', $verkavelingsvergunning, PDO::PARAM_INT);
            $stmtUpdateWettelijkeInfo->bindParam(':verkavelingsvergunningInfo', $_POST['verkavelingsvergunningInfo']);
            $voorkooprecht = isset($_POST['voorkooprecht']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':voorkooprecht', $voorkooprecht, PDO::PARAM_INT);
            $stmtUpdateWettelijkeInfo->bindParam(':voorkooprechtInfo', $_POST['voorkooprechtInfo']);
            $stmtUpdateWettelijkeInfo->bindParam(':stedenbouwkundigeBestemming', $_POST['stedenbouwkundigeBestemming']);
            $dagvaardingEnHerstelvordering = isset($_POST['dagvaardingEnHerstelvordering']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':dagvaardingEnHerstelvordering', $dagvaardingEnHerstelvordering, PDO::PARAM_INT);
            $effectiefOverstromingsgevoelig = isset($_POST['effectiefOverstromingsgevoelig']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':effectiefOverstromingsgevoelig', $effectiefOverstromingsgevoelig, PDO::PARAM_INT);
            $mogelijkOverstromingsgevoelig = isset($_POST['mogelijkOverstromingsgevoelig']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':mogelijkOverstromingsgevoelig', $mogelijkOverstromingsgevoelig, PDO::PARAM_INT);
            $afgebakendOverstromingsgebied = isset($_POST['afgebakendOverstromingsgebied']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':afgebakendOverstromingsgebied', $afgebakendOverstromingsgebied, PDO::PARAM_INT);
            $afgebakendeOeverzone = isset($_POST['afgebakendeOeverzone']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':afgebakendeOeverzone', $afgebakendeOeverzone, PDO::PARAM_INT);
            $risicozoneVoorOverstromingen = isset($_POST['risicozoneVoorOverstromingen']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':risicozoneVoorOverstromingen', $risicozoneVoorOverstromingen, PDO::PARAM_INT);
            $stmtUpdateWettelijkeInfo->bindParam(':overstromingskansPerceel', $_POST['overstromingskansPerceel']);
            $stmtUpdateWettelijkeInfo->bindParam(':overstromingskansGebouw', $_POST['overstromingskansGebouw']);
            $erfgoed = isset($_POST['erfgoed']) ? 1 : 0;
            $stmtUpdateWettelijkeInfo->bindParam(':erfgoed', $erfgoed, PDO::PARAM_INT);
            $stmtUpdateWettelijkeInfo->bindParam(':erfgoedInfo', $_POST['erfgoedInfo']);
            $stmtUpdateWettelijkeInfo->bindParam(':pandID', $_POST['pandID'], PDO::PARAM_INT);
            $stmtUpdateWettelijkeInfo->bindParam(':renovatieverplichting', $_POST['renovatieverplichting'], PDO::PARAM_INT);


            // Execute the query for wettelijkeinformatie
            $stmtUpdateWettelijkeInfo->execute();

            // ================== panddetails ==================

            $isNieuw = isset($_POST['isNieuw']) ? 1 : 0;
            $isOpbrengsteigendom = isset($_POST['isOpbrengsteigendom']) ? 1 : 0;
            $isExclusiefVastgoed = isset($_POST['isExclusiefVastgoed']) ? 1 : 0;
            $isBeleggingsvastgoed = isset($_POST['isBeleggingsvastgoed']) ? 1 : 0;

            // Prepare an UPDATE statement for panddetails
            $queryPandDetails = "UPDATE panddetails SET
            isNieuw = :isNieuw,
            isOpbrengsteigendom = :isOpbrengsteigendom,
            isExclusiefVastgoed = :isExclusiefVastgoed,
            isBeleggingsvastgoed = :isBeleggingsvastgoed
            WHERE pandDetailID = (SELECT pandDetailID FROM panden WHERE pandID = :pandID)";

            $stmtPandDetails = $db->prepare($queryPandDetails);

            // Bind parameters for panddetails
            $stmtPandDetails->bindParam(':isNieuw', $isNieuw, PDO::PARAM_INT);
            $stmtPandDetails->bindParam(':isOpbrengsteigendom', $isOpbrengsteigendom, PDO::PARAM_INT);
            $stmtPandDetails->bindParam(':isExclusiefVastgoed', $isExclusiefVastgoed, PDO::PARAM_INT);
            $stmtPandDetails->bindParam(':isBeleggingsvastgoed', $isBeleggingsvastgoed, PDO::PARAM_INT);
            $stmtPandDetails->bindParam(':pandID', $_POST['pandID'], PDO::PARAM_INT);

            // Execute the query for panddetails
            $stmtPandDetails->execute();

            // ================== panden ==================

            // Updating panden
            $queryUpdatePanden = "UPDATE panden SET
            titel = :titel,
            tekst = :tekst,
            status = :status,
            type = :type,
            subtype = :subtype,
            aanvullingSubtype = :aanvullingSubtype,
            bouwjaar = :bouwjaar,
            brutoVloeroppervlakte = :brutoVloeroppervlakte,
            grondoppervlakte = :grondoppervlakte,
            aantalSlaapkamers = :aantalSlaapkamers,
            prijs = :prijs,
            kadastraalInkomen = :kadastraalInkomen,
            bezoekOp = :bezoekOp,
            vrijOp = :vrijOp,
            homepage = :homepage
            WHERE pandID = :pandID";    

            $stmtUpdatePanden = $db->prepare($queryUpdatePanden);

            $stmtUpdatePanden->bindParam(':titel', $_POST['titel']);
            $stmtUpdatePanden->bindParam(':tekst', $_POST['tekst']);
            $stmtUpdatePanden->bindParam(':status', $_POST['status']);
            $stmtUpdatePanden->bindParam(':type', $_POST['type']);
            $stmtUpdatePanden->bindParam(':subtype', $_POST['subtype']);
            $stmtUpdatePanden->bindParam(':aanvullingSubtype', $_POST['aanvullingSubtype']);
            $stmtUpdatePanden->bindParam(':bouwjaar', $_POST['bouwjaar']);
            $stmtUpdatePanden->bindParam(':brutoVloeroppervlakte', $_POST['brutoVloeroppervlakte']);
            $stmtUpdatePanden->bindParam(':grondoppervlakte', $_POST['grondoppervlakte']);
            $stmtUpdatePanden->bindParam(':aantalSlaapkamers', $_POST['aantalSlaapkamers']);
            $stmtUpdatePanden->bindParam(':prijs', $_POST['prijs']);
            $stmtUpdatePanden->bindParam(':kadastraalInkomen', $_POST['kadastraalInkomen']);
            $stmtUpdatePanden->bindParam(':bezoekOp', $_POST['bezoekOp']);

            if (!empty($_POST['vrijOp']) && $_POST['vrijOp'] != 'date') {
                $stmtUpdatePanden->bindParam(':vrijOp', $_POST['vrijOp']);
            } 
            else {
                $stmtUpdatePanden->bindParam(':vrijOp', $_POST['vrijOpDate']);
            }

            $stmtUpdatePanden->bindParam(':homepage', $_POST['homepage']);
            $stmtUpdatePanden->bindParam(':pandID', $_POST['pandID'], PDO::PARAM_INT);

            $stmtUpdatePanden->execute();

            // ================== kamers ==================

            // Update kamers
            if (isset($_POST['kamerID']) && is_array($_POST['kamerID'])) {
                $kamerIDs = $_POST['kamerID'];
                $kamerNamen = $_POST['kamerNaam'];
                $kamerOppervlaktes = $_POST['kamerOppervlakte'];
                $kamerDetails = $_POST['kamerDetail'];

                foreach ($kamerIDs as $index => $kamerID) {
                    $queryUpdateKamer = "UPDATE kamers SET
            kamerNaam = :kamerNaam,
            kamerOppervlakte = :kamerOppervlakte,
            kamerDetail = :kamerDetail
        WHERE kamerID = :kamerID";
                    $stmtUpdateKamer = $db->prepare($queryUpdateKamer);

                    $stmtUpdateKamer->bindParam(':kamerNaam', $kamerNamen[$index]);
                    $stmtUpdateKamer->bindParam(':kamerOppervlakte', $kamerOppervlaktes[$index]);
                    $stmtUpdateKamer->bindParam(':kamerDetail', $kamerDetails[$index]);
                    $stmtUpdateKamer->bindParam(':kamerID', $kamerID, PDO::PARAM_INT);

                    $stmtUpdateKamer->execute();
                }
            }

            // Commit transaction
            $db->commit();

            header("Location: ../pandUpdate.php?pandID=" . $_POST['pandID'] . "&message=updated");
        }

    } catch (PDOException $exception) {
        // Rollback transaction if any error occurs
        $db->rollBack();
        exit("Error: " . $exception->getMessage());
    }
};
