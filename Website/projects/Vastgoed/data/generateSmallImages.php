<?php
require_once('DBConfig.php');
ini_set('memory_limit', '256M');
ini_set('max_execution_time', '400'); // 300 seconds

/**
 * Resize an image to a specific width while maintaining aspect ratio.
 *
 * @param string $sourcePath Path to the original image.
 * @param string $destinationPath Path to save the resized image.
 * @param int $newWidth Desired width of the resized image.
 */
function resizeImage($sourcePath, $destinationPath, $newWidth)
{
    // Get original image dimensions and type
    $imageInfo = getimagesize($sourcePath);
    if ($imageInfo === false) {
        throw new Exception("Invalid image file: " . $sourcePath);
    }

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

// Database setup
$database = new Database();
$db = $database->getConnection();

try {
    // Fetch all original images (klein = 0)
    $query = "SELECT afbeeldingID, pandID, afbeeldingURL FROM afbeeldingen WHERE klein = 0";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $afbeeldingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Start transaction
    $db->beginTransaction();

    foreach ($afbeeldingen as $afbeelding) {
        $afbeeldingID = $afbeelding['afbeeldingID'];
        $pandID = $afbeelding['pandID'];
        $originalPath = __DIR__ . '/../' . ltrim($afbeelding['afbeeldingURL'], './'); // Resolve original file path

        $fileInfo = pathinfo($afbeelding['afbeeldingURL']); // Get file name and extension
        $smallFileName = $fileInfo['filename'] . '_small.' . $fileInfo['extension']; // Add _small to the file name
        $smallFilePath = __DIR__ . '/../assets/img/panden/' . $smallFileName; // Path for the new small image
        $smallFileURL = './assets/img/panden/' . $smallFileName;

        // Resize the image to 400px width
        try {
            resizeImage($originalPath, $smallFilePath, 400);

            // Insert new small image into the database
            $insertQuery = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, klein) 
                            VALUES (:pandID, :afbeeldingURL, :klein)";
            $insertStmt = $db->prepare($insertQuery);
            $insertStmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
            $insertStmt->bindParam(':afbeeldingURL', $smallFileURL, PDO::PARAM_STR);
            $insertStmt->bindValue(':klein', 1, PDO::PARAM_INT); // klein = 1
            $insertStmt->execute();

            echo "Small image created for afbeeldingID $afbeeldingID\n";
        } catch (Exception $e) {
            echo "Error creating small image for afbeeldingID $afbeeldingID: " . $e->getMessage() . "\n";
        }
    }

    // Commit transaction
    $db->commit();
    echo "Small images successfully created!";
} catch (PDOException $e) {
    // Rollback transaction on error
    $db->rollBack();
    exit("Error: " . $e->getMessage());
}
