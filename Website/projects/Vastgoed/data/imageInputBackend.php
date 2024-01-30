<?php

require_once('DBConfig.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['upload'])) {
        $pandID = (int)$_POST['pandID'] ?? '';
        $targetDir = "../assets/img/panden/";
        $targetDirForAanbod = "./assets/img/panden/";

        $database = new Database();
        $db = $database->getConnection();
        $db->beginTransaction();

        try {
            foreach ($_FILES['image']['name'] as $key => $imageName) {
                $fileName = basename($imageName);
                $targetFilePath = $targetDir . $fileName;
                $targetFilePathForAanbod = $targetDirForAanbod . $fileName;
                $description = $_POST['description'][$key] ?? '';

                $check = getimagesize($_FILES["image"]["tmp_name"][$key]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetFilePath)) {
                        $queryAfbeeldingen = "INSERT INTO afbeeldingen (pandID, afbeeldingURL, beschrijving) 
                    VALUES (:pandID, :afbeeldingURL, :beschrijving)";

                        $stmt = $db->prepare($queryAfbeeldingen);
                        $stmt->bindParam(':pandID', $pandID);
                        $stmt->bindParam(':afbeeldingURL', $targetFilePathForAanbod);
                        $stmt->bindParam(':beschrijving', $description);
                        $stmt->execute();
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

    if (isset($_POST['action']) && $_POST['action'] === 'delete_images' && !empty($_POST['imagesToDelete'])) {
        $pandID = $_POST['pandID'];
        $imagesToDelete = $_POST['imagesToDelete'];

        try {
            $database = new Database();
            $db = $database->getConnection();
            $db->beginTransaction();

            foreach ($imagesToDelete as $imageURL) {
                $filePath = '../' . $imageURL; 
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $stmt = $db->prepare("DELETE FROM afbeeldingen WHERE pandID = :pandID AND afbeeldingURL = :afbeeldingURL");
                $stmt->bindParam(':pandID', $pandID);
                $stmt->bindParam(':afbeeldingURL', $imageURL);
                $stmt->execute();
            }

            $db->commit();
            header("Location: ../images.php?pandID=$pandID&message=removed");
        } catch (PDOException $e) {
            $db->rollBack();
            exit("Error: " . $e->getMessage());
        }
    }
}
