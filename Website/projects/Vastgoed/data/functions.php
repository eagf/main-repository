<?php

function getPandDetails($pandID)
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT p.*, a.*, pd.*, wi.*, GROUP_CONCAT(af.afbeeldingURL) as afbeeldingen
              FROM panden p
              LEFT JOIN adressen a ON p.adresID = a.adresID
              LEFT JOIN pandDetails pd ON p.pandDetailID = pd.pandDetailID
              LEFT JOIN wettelijkeInformatie wi ON p.wettelijkeInfoID = wi.wettelijkeInfoID
              LEFT JOIN afbeeldingen af ON p.pandID = af.pandID
              WHERE p.pandID = ?
              GROUP BY p.pandID";

    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $pandID);
        $stmt->execute();

        $pandData = $stmt->fetch(PDO::FETCH_ASSOC);
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
