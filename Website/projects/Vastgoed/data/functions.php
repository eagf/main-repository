<?php
ini_set('memory_limit', '256M');
ini_set('max_execution_time', '400'); // 300 seconds

function deletePand($pandID)
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $db->beginTransaction();

        // Step -1: Fetch all image URLs + delete images (related to pand)
        $queryFetchUrls = "SELECT afbeeldingURL FROM afbeeldingen WHERE pandID = :pandID";
        $stmtFetchUrls = $db->prepare($queryFetchUrls);
        $stmtFetchUrls->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtFetchUrls->execute();
        $imageUrls = $stmtFetchUrls->fetchAll(PDO::FETCH_COLUMN);

        // Determine the base directory dynamically
        $basePath = realpath(__DIR__ . '/../assets/img/panden/') . '/';

        foreach ($imageUrls as $imageUrl) {
            $filePath = $basePath . basename($imageUrl);
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                echo "No images found in the path: " . $filePath . "<br>";
                echo "The directory of this server is: " . __DIR__;
            }
        }

        // Step 0: Delete from afbeeldingen table (related to pand)
        $queryDeleteAfbeeldingen = "DELETE FROM afbeeldingen WHERE pandID = :pandID";
        $stmtDeleteAfbeeldingen = $db->prepare($queryDeleteAfbeeldingen);
        $stmtDeleteAfbeeldingen->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteAfbeeldingen->execute();

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

        // Step 3: Delete from wettelijkeinformatie table (related to pand)
        $queryDeleteWettelijkeInfo = "DELETE FROM wettelijkeinformatie WHERE wettelijkeInfoID = 
            (SELECT wettelijkeInfoID FROM panden WHERE pandID = :pandID)";
        $stmtDeleteWettelijkeInfo = $db->prepare($queryDeleteWettelijkeInfo);
        $stmtDeleteWettelijkeInfo->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteWettelijkeInfo->execute();

        // Step 4: Delete from adressen table (related to pand)
        $queryDeleteAdressen = "DELETE FROM adressen WHERE adresID = 
            (SELECT adresID FROM panden WHERE pandID = :pandID)";
        $stmtDeleteAdressen = $db->prepare($queryDeleteAdressen);
        $stmtDeleteAdressen->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmtDeleteAdressen->execute();

        $db->commit();
    } catch (PDOException $exception) {
        $db->rollBack();
        exit("Error: " . $exception->getMessage());
    }
}

function getPandenSelect()
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT pandID, titel, status, type, prijs FROM panden";
        $stmt = $db->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pandID = $row['pandID'];
            $titel = $row['titel'];
            $status = $row['status'];
            $type = $row['type'];
            $prijs = $row['prijs'];

            echo "<option value='$pandID'>$titel - $status - $type - $prijs</option>";
        }
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}

function getPandDetailsByPandID($pandID)
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT titel, status, type, prijs FROM panden WHERE pandID = :pandID";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $titel = $row['titel'];
            $status = $row['status'];
            $type = $row['type'];
            $prijs = $row['prijs'];

            echo "<h2 class='images-title'>$titel - $status - $type - $prijs</h2>";
        }
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}

function getPandDetailsMetaImage($pandID)
{
    $database = new Database();
    $db = $database->getConnection();

    $queryPand = "SELECT afbeeldingURL
                  FROM afbeeldingen
                  WHERE pandID = ? AND klein = 1
                  ORDER BY volgorde ASC
                  LIMIT 1";

    try {
        $stmtPand = $db->prepare($queryPand);
        $stmtPand->bindParam(1, $pandID, PDO::PARAM_INT);
        $stmtPand->execute();
        $pandData = $stmtPand->fetch(PDO::FETCH_ASSOC);

        if ($pandData) {
            $baseURL = 'https://www.libeervastgoed.be/';
            $pandData['afbeeldingURL'] = $baseURL . ltrim($pandData['afbeeldingURL'], './');
        }

        return $pandData;
    } catch (PDOException $exception) {
        exit("Error: " . $exception->getMessage());
    }
}

function getPandDetails($pandID)
{
    $database = new Database();
    $db = $database->getConnection();

    $queryPand = "SELECT p.*, a.*, wi.*,
                     GROUP_CONCAT(DISTINCT af.afbeeldingURL ORDER BY af.volgorde SEPARATOR '|') AS afbeeldingen,
                     GROUP_CONCAT(DISTINCT af.beschrijving ORDER BY af.volgorde SEPARATOR '|') AS beschrijvingen,
                     (SELECT GROUP_CONCAT(CONCAT_WS('|', kamerNaam, kamerOppervlakte, kamerDetail) SEPARATOR '||') 
                      FROM kamers 
                      WHERE pandID = p.pandID
                     ) AS kamers
              FROM panden p
              LEFT JOIN adressen a ON p.adresID = a.adresID
              LEFT JOIN wettelijkeinformatie wi ON p.wettelijkeInfoID = wi.wettelijkeInfoID
              LEFT JOIN afbeeldingen af ON p.pandID = af.pandID AND af.klein = 0
              WHERE p.pandID = ?
              GROUP BY p.pandID";

    try {
        $stmtPand = $db->prepare($queryPand);
        $stmtPand->bindParam(1, $pandID);
        $stmtPand->execute();
        $pandData = $stmtPand->fetch(PDO::FETCH_ASSOC);

        $queryKamers = "SELECT * FROM kamers WHERE pandID = ?";
        $stmtKamers = $db->prepare($queryKamers);
        $stmtKamers->bindParam(1, $pandID);
        $stmtKamers->execute();
        $kamerData = $stmtKamers->fetchAll(PDO::FETCH_ASSOC);

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

    $query = "SELECT p.pandID, p.status, p.titel, a.gemeente, p.prijs, p.isNieuw, p.isVerkochtVerhuurd,
            GROUP_CONCAT(af.afbeeldingURL ORDER BY af.volgorde ASC) as afbeeldingen
            FROM panden p
            LEFT JOIN adressen a ON p.adresID = a.adresID
            LEFT JOIN afbeeldingen af ON p.pandID = af.pandID AND af.klein = 1";

    if ($statusFilter !== 'all') {
        $query .= " WHERE p.status = :statusFilter";
    }

    $query .= " GROUP BY p.pandID, p.isVerkochtVerhuurd";
    $query .= " ORDER BY p.isVerkochtVerhuurd ASC, p.pandID ASC";

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



function getImagesByPandID($pandID)
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT * FROM afbeeldingen WHERE pandID = :pandID AND klein = 0 ORDER BY volgorde ASC");

        $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);

        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}

function getFirstSmallImage($pandID)
{
    try {
        $database = new Database();
        $db = $database->getConnection();

        $stmt = $db->prepare("SELECT top1 FROM afbeeldingen WHERE pandID = :pandID AND klein = 0 ORDER BY volgorde ASC");

        $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);

        $stmt->execute();

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $images;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}


function getPandenByHomepage()
{
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT p.pandID, p.status, p.isVerkochtVerhuurd, af.afbeeldingURL 
                FROM afbeeldingen af 
                INNER JOIN panden p ON af.pandID = p.pandID 
                WHERE p.homepage = 1 AND af.klein = 1 AND af.volgorde = 1
                GROUP BY p.pandID";

    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
}

function resizeImage($sourcePath, $destinationPath, $newWidth)
{
    // Get original image dimensions and type
    $imageInfo = getimagesize($sourcePath);
    $originalWidth = $imageInfo[0];
    $originalHeight = $imageInfo[1];
    $mimeType = $imageInfo['mime'];

    // Calculate new dimensions while maintaining aspect ratio
    $aspectRatio = $originalHeight / $originalWidth;
    $newHeight = (int)($newWidth * $aspectRatio);

    // Create a blank image with new dimensions
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Create the original image based on its type
    switch ($mimeType) {
        case 'image/jpeg':
            $originalImage = imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $originalImage = imagecreatefrompng($sourcePath);
            break;
        case 'image/webp':
            $originalImage = imagecreatefromwebp($sourcePath);
            break;
        default:
            throw new Exception("Unsupported image type: " . $mimeType);
    }

    // Resize the original image
    imagecopyresampled(
        $resizedImage,
        $originalImage,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $originalWidth,
        $originalHeight
    );

    // Save the resized image
    switch ($mimeType) {
        case 'image/jpeg':
            imagejpeg($resizedImage, $destinationPath, 90); // 90% quality
            break;
        case 'image/png':
            imagepng($resizedImage, $destinationPath, 8); // Compression level 8
            break;
        case 'image/webp':
            imagewebp($resizedImage, $destinationPath, 90); // 90% quality
            break;
    }

    // Free up memory
    imagedestroy($originalImage);
    imagedestroy($resizedImage);
}
