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
            // Fetch the next available DuplicateID
            $queryGetMaxDuplicateID = "SELECT IFNULL(MAX(duplicateID), 0) + 1 AS nextDuplicateID FROM afbeeldingen";
            $stmtMaxDuplicateID = $db->prepare($queryGetMaxDuplicateID);
            $stmtMaxDuplicateID->execute();
            $nextDuplicateID = (int)$stmtMaxDuplicateID->fetchColumn();

            // Initialize volgordeCounter
            $volgordeCounter = 1;

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

                $check = getimagesize($_FILES["image"]["tmp_name"][$key]);
                if ($check !== false) {
                    // Save original image
                    if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)) {

                        // Save smaller version of the image
                        resizeImage($targetFilePath, $targetFilePathSmall, 400);

                        // Insert original image into the database (klein = 0)
                        $queryAfbeeldingen = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, beschrijving, klein, volgorde, duplicateID) 
                        VALUES (:pandID, :afbeeldingURL, :beschrijving, :klein, :volgorde, :duplicateID)";
                        $stmt = $db->prepare($queryAfbeeldingen);
                        $stmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                        $stmt->bindParam(':afbeeldingURL', $targetFilePathForAanbod, PDO::PARAM_STR);
                        $stmt->bindParam(':beschrijving', $description, PDO::PARAM_STR);
                        $stmt->bindValue(':klein', 0, PDO::PARAM_INT); // Mark as original image
                        $stmt->bindParam(':volgorde', $volgordeCounter, PDO::PARAM_INT); // Assign volgorde
                        $stmt->bindParam(':duplicateID', $nextDuplicateID, PDO::PARAM_INT); // Assign duplicateID
                        $stmt->execute();

                        // Insert small image into the database (klein = 1)
                        $queryAfbeeldingenSmall = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, beschrijving, klein, volgorde, duplicateID) 
                        VALUES (:pandID, :afbeeldingURL, :beschrijving, :klein, :volgorde, :duplicateID)";
                        $stmtSmall = $db->prepare($queryAfbeeldingenSmall);
                        $stmtSmall->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                        $stmtSmall->bindParam(':afbeeldingURL', $targetFilePathSmallForAanbod, PDO::PARAM_STR);
                        $stmtSmall->bindParam(':beschrijving', $description, PDO::PARAM_STR);
                        $stmtSmall->bindValue(':klein', 1, PDO::PARAM_INT); // Mark as small image
                        $stmtSmall->bindParam(':volgorde', $volgordeCounter, PDO::PARAM_INT); // Assign volgorde
                        $stmtSmall->bindParam(':duplicateID', $nextDuplicateID, PDO::PARAM_INT); // Assign duplicateID
                        $stmtSmall->execute();

                        // Increment volgordeCounter and nextDuplicateID
                        $volgordeCounter++;
                        $nextDuplicateID++;
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


    // ============ change order images ============
    if ($_POST['action'] === 'update_order' && isset($_POST['order'])) {
        $pandID = $_POST['pandID'];
        $order = $_POST['order'];

        try {
            $database = new Database();
            $db = $database->getConnection();
            $db->beginTransaction();

            foreach ($order as $afbeeldingID => $volgorde) {
                // Fetch the duplicateID for the current afbeeldingID
                $stmtFetchDuplicateID = $db->prepare("SELECT duplicateID FROM afbeeldingen WHERE afbeeldingID = :afbeeldingID AND pandID = :pandID");
                $stmtFetchDuplicateID->bindParam(':afbeeldingID', $afbeeldingID, PDO::PARAM_INT);
                $stmtFetchDuplicateID->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtFetchDuplicateID->execute();
                $duplicateID = $stmtFetchDuplicateID->fetchColumn();

                // Update the volgorde for all afbeeldingen with the same duplicateID
                $stmtUpdateVolgorde = $db->prepare("UPDATE afbeeldingen SET volgorde = :volgorde WHERE duplicateID = :duplicateID AND pandID = :pandID");
                $stmtUpdateVolgorde->bindParam(':volgorde', $volgorde, PDO::PARAM_INT);
                $stmtUpdateVolgorde->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
                $stmtUpdateVolgorde->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtUpdateVolgorde->execute();
            }

            $db->commit();
            header("Location: ../images.php?pandID=$pandID&message=order_updated");
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
                // Fetch the duplicateID for the current imageURL
                $stmtFetchDuplicateID = $db->prepare("SELECT duplicateID FROM afbeeldingen WHERE afbeeldingURL = :afbeeldingURL AND pandID = :pandID");
                $stmtFetchDuplicateID->bindParam(':afbeeldingURL', $imageURL, PDO::PARAM_STR);
                $stmtFetchDuplicateID->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtFetchDuplicateID->execute();
                $duplicateID = $stmtFetchDuplicateID->fetchColumn();

                // Fetch all image URLs with the same duplicateID
                $stmtFetchImageURLs = $db->prepare("SELECT afbeeldingURL FROM afbeeldingen WHERE duplicateID = :duplicateID AND pandID = :pandID");
                $stmtFetchImageURLs->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
                $stmtFetchImageURLs->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtFetchImageURLs->execute();
                $imageURLs = $stmtFetchImageURLs->fetchAll(PDO::FETCH_COLUMN);

                // Delete the image files
                foreach ($imageURLs as $url) {
                    $filePath = '../' . ltrim($url, './'); // Ensure correct path
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Delete images from the database
                $stmtDeleteImages = $db->prepare("DELETE FROM afbeeldingen WHERE duplicateID = :duplicateID AND pandID = :pandID");
                $stmtDeleteImages->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
                $stmtDeleteImages->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtDeleteImages->execute();
            }

            // Reassign volgorde values for remaining images
            $stmtFetchRemainingImages = $db->prepare("SELECT duplicateID FROM afbeeldingen WHERE pandID = :pandID GROUP BY duplicateID ORDER BY MIN(volgorde) ASC");
            $stmtFetchRemainingImages->bindParam(':pandID', $pandID, PDO::PARAM_INT);
            $stmtFetchRemainingImages->execute();
            $remainingImages = $stmtFetchRemainingImages->fetchAll(PDO::FETCH_COLUMN);

            $volgordeCounter = 1;
            foreach ($remainingImages as $duplicateID) {
                $stmtUpdateVolgorde = $db->prepare("UPDATE afbeeldingen SET volgorde = :volgorde WHERE duplicateID = :duplicateID AND pandID = :pandID");
                $stmtUpdateVolgorde->bindParam(':volgorde', $volgordeCounter, PDO::PARAM_INT);
                $stmtUpdateVolgorde->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
                $stmtUpdateVolgorde->bindParam(':pandID', $pandID, PDO::PARAM_INT);
                $stmtUpdateVolgorde->execute();
                $volgordeCounter++;
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
