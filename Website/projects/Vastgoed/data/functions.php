<?php

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
                  LEFT JOIN pandDetails pd ON p.pandDetailID = pd.pandDetailID
                  LEFT JOIN wettelijkeInformatie wi ON p.wettelijkeInfoID = wi.wettelijkeInfoID
                  LEFT JOIN afbeeldingen af ON p.pandID = af.pandID
                  WHERE p.pandID = ?
                  GROUP BY p.pandID";

    try {
        $stmtPand = $db->prepare($queryPand);
        $stmtPand->bindParam(1, $pandID);
        $stmtPand->execute();
        $pandData = $stmtPand->fetch(PDO::FETCH_ASSOC);

        // Process the kamers data if it exists
        if ($pandData && $pandData['kamers']) {
            $kamers = array_map(function ($kamerStr) {
                list($naam, $oppervlakte, $detail) = explode('|', $kamerStr);
                return ['kamerNaam' => $naam, 'kamerOppervlakte' => $oppervlakte, 'kamerDetail' => $detail];
            }, explode('||', $pandData['kamers']));
            $pandData['kamers'] = $kamers;
        }

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
