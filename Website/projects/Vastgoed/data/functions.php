<?php

function deletePand($pandID)
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $db->beginTransaction();

        // Step 1: Delete from kamers table (related to pand)
        $queryDeleteKamers = "DELETE FROM kamers WHERE pandID = :pandID";
        $stmtDeleteKamers = $db->prepare($queryDeleteKamers);
        $stmtDeleteKamers->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteKamers->execute();

        // Step 2: Delete from panden table
        $queryDeletePanden = "DELETE FROM panden WHERE pandID = :pandID";
        $stmtDeletePanden = $db->prepare($queryDeletePanden);
        $stmtDeletePanden->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeletePanden->execute();

        // Step 3: Delete from panddetails table (related to pand)
        $queryDeletePandDetails = "DELETE FROM panddetails WHERE pandDetailID = 
                (SELECT pandDetailID FROM panden WHERE pandID = :pandID)";
        $stmtDeletePandDetails = $db->prepare($queryDeletePandDetails);
        $stmtDeletePandDetails->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeletePandDetails->execute();

        // Step 4: Delete from wettelijkeinformatie table (related to pand)
        $queryDeleteWettelijkeInfo = "DELETE FROM wettelijkeinformatie WHERE wettelijkeInfoID = 
                (SELECT wettelijkeInfoID FROM panden WHERE pandID = :pandID)";
        $stmtDeleteWettelijkeInfo = $db->prepare($queryDeleteWettelijkeInfo);
        $stmtDeleteWettelijkeInfo->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteWettelijkeInfo->execute();

        // Step 5: Delete from adressen table (related to pand)
        $queryDeleteAdressen = "DELETE FROM adressen WHERE adresID = 
                (SELECT adresID FROM panden WHERE pandID = :pandID)";
        $stmtDeleteAdressen = $db->prepare($queryDeleteAdressen);
        $stmtDeleteAdressen->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteAdressen->execute();

        // Commit transaction
        $db->commit();
    } catch (PDOException $exception) {
        // Rollback transaction if any error occurs
        $db->rollBack();
        exit("Error: " . $exception->getMessage());
    }
}


function getPandenSelect()
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        // Query to retrieve "panden" data
        $query = "SELECT pandID, titel, status, type, prijs FROM panden";
        $stmt = $db->prepare($query);
        $stmt->execute();

        // Fetch and display "panden" data as options
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pandID = $row['pandID'];
            $titel = $row['titel'];
            $status = $row['status'];
            $type = $row['type'];
            $prijs = $row['prijs'];

            // Display the options with pandID as the value
            echo "<option value='$pandID'>$titel - $status - $type - $prijs</option>";
        }
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}

function getPandDetails($pandID)
{
    $database = new Database();
    $db = $database->getConnection();

    // Query to get pand details, address, pand details, legal information, images, and aggregated room details
    $queryPand = "SELECT p.*, a.*, pd.*, wi.*, 
                         GROUP_CONCAT(af.afbeeldingURL) as afbeeldingen,
                         (SELECT GROUP_CONCAT(CONCAT_WS('|', kamerNaam, kamerOppervlakte, kamerDetail) SEPARATOR '||') 
                          FROM kamers 
                          WHERE pandID = p.pandID
                         ) as kamers
                  FROM panden p
                  LEFT JOIN adressen a ON p.adresID = a.adresID
                  LEFT JOIN panddetails pd ON p.pandDetailID = pd.pandDetailID
                  LEFT JOIN wettelijkeinformatie wi ON p.wettelijkeInfoID = wi.wettelijkeInfoID
                  LEFT JOIN afbeeldingen af ON p.pandID = af.pandID
                  WHERE p.pandID = ?
                  GROUP BY p.pandID";

    try {
        $stmtPand = $db->prepare($queryPand);
        $stmtPand->bindParam(1, $pandID);
        $stmtPand->execute();
        $pandData = $stmtPand->fetch(PDO::FETCH_ASSOC);


        // Fetch room details separately
        $queryKamers = "SELECT * FROM kamers WHERE pandID = ?";
        $stmtKamers = $db->prepare($queryKamers);
        $stmtKamers->bindParam(1, $pandID);
        $stmtKamers->execute();
        $kamerData = $stmtKamers->fetchAll(PDO::FETCH_ASSOC);

        // Group rooms by room type (kamerNaam)
        $groupedKamers = [];
        foreach ($kamerData as $kamer) {
            $groupedKamers[$kamer['kamerNaam']][] = $kamer;
        }

        $pandData['kamers'] = $groupedKamers;


        return $pandData;
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}


function getPandenOverzicht($statusFilter)
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT p.pandID, p.titel, a.gemeente, p.prijs, GROUP_CONCAT(af.afbeeldingURL) as afbeeldingen
              FROM panden p
              LEFT JOIN adressen a ON p.adresID = a.adresID
              LEFT JOIN afbeeldingen af ON p.pandID = af.pandID";

    if ($statusFilter !== 'all') {
        $query .= " WHERE p.status = :statusFilter";
    }

    $query .= " GROUP BY p.pandID";

    try {
        $stmt = $db->prepare($query);

        if ($statusFilter !== 'all') {
            $stmt->bindParam(':statusFilter', $statusFilter);
        }

        $stmt->execute();

        $panden = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $panden;
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}
