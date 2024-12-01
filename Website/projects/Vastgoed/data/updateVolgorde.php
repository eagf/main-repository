<?php
require_once('DBConfig.php'); // Include your database configuration

updateVolgorde();

/**
 * Update volgorde for afbeeldingen with klein = 0 and volgorde = 0.
 */
function updateVolgorde()
{
    $database = new Database();
    $db = $database->getConnection();

    try {
        // Start a transaction
        $db->beginTransaction();

        // Fetch all afbeeldingen with klein = 0 and volgorde = 0, ordered by pandID and afbeeldingID
        $query = "SELECT afbeeldingID, pandID FROM afbeeldingen WHERE klein = 0 AND volgorde = 0 ORDER BY pandID, afbeeldingID";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $afbeeldingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $currentPandID = null;
        $volgordeCounter = 1;

        foreach ($afbeeldingen as $afbeelding) {
            $afbeeldingID = $afbeelding['afbeeldingID'];
            $pandID = $afbeelding['pandID'];

            // Reset volgordeCounter when pandID changes
            if ($currentPandID !== $pandID) {
                $currentPandID = $pandID;
                $volgordeCounter = 1;
            }

            // Update the volgorde for the current afbeelding
            $updateQuery = "UPDATE afbeeldingen SET volgorde = :volgorde WHERE afbeeldingID = :afbeeldingID";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bindParam(':volgorde', $volgordeCounter, PDO::PARAM_INT);
            $updateStmt->bindParam(':afbeeldingID', $afbeeldingID, PDO::PARAM_INT);
            $updateStmt->execute();

            // Increment volgordeCounter
            $volgordeCounter++;
        }

        // Commit transaction
        $db->commit();

        echo "Volgorde updated successfully!";
    } catch (PDOException $e) {
        // Rollback transaction on error
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
}


