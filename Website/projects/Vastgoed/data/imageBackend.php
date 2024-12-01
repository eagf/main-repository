<?php
ini_set('memory_limit', '256M');
ini_set('max_execution_time', '400'); // 300 seconds

require_once('DBConfig.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ============ upload images ============
    if (isset($_POST['upload'])) {
        $pandID = (int)$_POST['pandID'] ?? '';
        $targetDir = "../assets/img/panden/";
        $targetDirForAanbod = "./assets/img/panden/";

        $database = new Database();
        $db = $database->getConnection();
        $db->beginTransaction();

        try {
            foreach ($_FILES['image']['name'] as $key => $imageName) {
                $originalFileName = basename($imageName);
                $fileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION)); // Extract the file extension

                $timestamp = time(); // Generate a single timestamp
                $randomNumber = rand(1000, 9999); // Generate a single random number

                $newFileName = 'image_' . $timestamp . '_' . $randomNumber . '.' . $fileType; // Original file name
                $newFileNameSmall = 'image_' . $timestamp . '_' . $randomNumber . '_small.' . $fileType; // Small file name

                $targetFilePath = $targetDir . $newFileName;
                $targetFilePathSmall = $targetDir . $newFileNameSmall;
                $targetFilePathForAanbod = $targetDirForAanbod . $newFileName;
                $targetFilePathSmallForAanbod = $targetDirForAanbod . $newFileNameSmall;

                $description = $_POST['description'][$key] ?? '';

                // Fetch the next available volgorde value for the pandID
                $queryGetMaxVolgorde = "SELECT IFNULL(MAX(volgorde), 0) + 1 AS nextVolgorde FROM afbeeldingen WHERE pandID = :pandID AND klein = 0";
                $stmtMaxVolgorde = $db->prepare($queryGetMaxVolgorde);
                $stmtMaxVolgorde->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtMaxVolgorde->execute();
                $nextVolgorde = (int)$stmtMaxVolgorde->fetchColumn();

                $check = getimagesize($_FILES["image"]["tmp_name"][$key]);
                if ($check !== false) {
                    // Save original image
                    if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)) {

                        // Save smaller version of the image
                        resizeImage($targetFilePath, $targetFilePathSmall, 400);

                        // Insert original image into the database (klein = 0)
                        $queryAfbeeldingen = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, beschrijving, klein, volgorde) 
                            VALUES (:pandID, :afbeeldingURL, :beschrijving, :klein, :volgorde)";
                        $stmt = $db->prepare($queryAfbeeldingen);
                        $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                        $stmt->bindParam(':afbeeldingURL', $targetFilePathForAanbod, PDO::PARAM_STR);
                        $stmt->bindParam(':beschrijving', $description, PDO::PARAM_STR);
                        $stmt->bindValue(':klein', 0, PDO::PARAM_INT); // Mark as original image
                        $stmt->bindParam(':volgorde', $nextVolgorde, PDO::PARAM_INT); // Assign next volgorde
                        $stmt->execute();

                        // Insert small image into the database (klein = 1)
                        $queryAfbeeldingenSmall = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, beschrijving, klein, volgorde) 
                            VALUES (:pandID, :afbeeldingURL, :beschrijving, :klein, :volgorde)";
                        $stmtSmall = $db->prepare($queryAfbeeldingenSmall);
                        $stmtSmall->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                        $stmtSmall->bindParam(':afbeeldingURL', $targetFilePathSmallForAanbod, PDO::PARAM_STR);
                        $stmtSmall->bindParam(':beschrijving', $description, PDO::PARAM_STR);
                        $stmtSmall->bindValue(':klein', 1, PDO::PARAM_INT); // Mark as small image
                        $stmtSmall->bindValue(':volgorde', 0, PDO::PARAM_INT);
                        $stmtSmall->execute();
                    }
                }
            }

            // Commit transaction
            $db->commit();
            header("Location: ../images.php?pandID=$pandID&message=added");
        } catch (PDOException $e) {
            $db->rollBack();
            exit("Error: " . $e->getMessage());
        }
    }

    // ============ delete images ============
if (isset($_POST['action']) && $_POST['action'] === 'delete_images' && !empty($_POST['imagesToDelete'])) {
    $pandID = $_POST['pandID'];
    $imagesToDelete = $_POST['imagesToDelete'];

    try {
        $database = new Database();
        $db = $database->getConnection();
        $db->beginTransaction();

        foreach ($imagesToDelete as $imageURL) {
            // Delete the original image file
            $filePath = '../' . ltrim($imageURL, './'); // Ensure correct path
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Generate the small image URL
            $fileInfo = pathinfo($imageURL); // Get file info
            $smallImageURL = $fileInfo['dirname'] . '/' . $fileInfo['filename'] . '_small.' . $fileInfo['extension'];
            $smallFilePath = '../' . ltrim($smallImageURL, './'); // Ensure correct path

            // Delete the small image file
            if (file_exists($smallFilePath)) {
                unlink($smallFilePath);
            }

            // Delete both original and small images from the database
            $stmt = $db->prepare("DELETE FROM afbeeldingen 
                WHERE pandID = :pandID 
                AND (afbeeldingURL = :afbeeldingURL OR afbeeldingURL = :smallAfbeeldingURL)");
            $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
            $stmt->bindParam(':afbeeldingURL', $imageURL, PDO::PARAM_STR);
            $stmt->bindParam(':smallAfbeeldingURL', $smallImageURL, PDO::PARAM_STR);
            $stmt->execute();
        }

        // Commit the transaction
        $db->commit();
        header("Location: ../images.php?pandID=$pandID&message=removed");
    } catch (PDOException $e) {
        $db->rollBack();
        exit("Error: " . $e->getMessage());
    }
}



    // ============ update descriptions ============

    if ($_POST['action'] === 'update_descriptions' && isset($_POST['descriptions'])) {
        $pandID = $_POST['pandID'];
        $descriptions = $_POST['descriptions'];

        try {
            $database = new Database();
            $db = $database->getConnection();
            $db->beginTransaction();

            foreach ($descriptions as $afbeeldingID => $description) {
                $stmt = $db->prepare("UPDATE afbeeldingen 
                SET beschrijving = :beschrijving 
                WHERE afbeeldingID = :afbeeldingID 
                AND pandID = :pandID 
                AND klein = 0");
                $stmt->bindParam(':beschrijving', $description);
                $stmt->bindParam(':afbeeldingID', $afbeeldingID);
                $stmt->bindParam(':pandID', $pandID);
                $stmt->execute();
            }

            $db->commit();
            header("Location: ../images.php?pandID=$pandID&message=updated");
        } catch (PDOException $e) {
            $db->rollBack();
            exit("Error: " . $e->getMessage());
        }
    }
}
