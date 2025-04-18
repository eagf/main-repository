<?php
require_once('DBConfig.php'); // Include your database configuration

class DuplicateIDUpdater {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function updateDuplicateID() {
        try {
            // Start a transaction
            $this->db->beginTransaction();

            // Fetch all afbeeldingen ordered by pandID and afbeeldingID
            $query = "SELECT afbeeldingID, afbeeldingURL FROM afbeeldingen ORDER BY pandID, afbeeldingID";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $afbeeldingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $duplicateIDCounter = 1;
            $urlMap = [];

            foreach ($afbeeldingen as $afbeelding) {
                $afbeeldingID = $afbeelding['afbeeldingID'];
                $afbeeldingURL = $afbeelding['afbeeldingURL'];

                // Remove "_small" from the URL if present
                $normalizedURL = preg_replace('/_small(?=\.(jpg|png|jpeg))/', '', $afbeeldingURL);

                if (!isset($urlMap[$normalizedURL])) {
                    $urlMap[$normalizedURL] = $duplicateIDCounter++;
                }

                $duplicateID = $urlMap[$normalizedURL];

                // Update the duplicateID for the current afbeelding
                $updateQuery = "UPDATE afbeeldingen SET duplicateID = :duplicateID WHERE afbeeldingID = :afbeeldingID";
                $updateStmt = $this->db->prepare($updateQuery);
                $updateStmt->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
                $updateStmt->bindParam(':afbeeldingID', $afbeeldingID, PDO::PARAM_INT);
                $updateStmt->execute();
            }

            // Commit transaction
            $this->db->commit();

            echo "DuplicateID updated successfully!";
        } catch (PDOException $e) {
            // Rollback transaction on error
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
}

// Run the updateDuplicateID method
$duplicateIDUpdater = new DuplicateIDUpdater();
$duplicateIDUpdater->updateDuplicateID();
