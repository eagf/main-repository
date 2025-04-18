<?php
require_once('DBConfig.php'); // Include your database configuration

class VolgordeUpdater {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function updateVolgorde() {
        try {
            // Start a transaction
            $this->db->beginTransaction();

            // Fetch all afbeeldingen with klein = 0 and volgorde = 0, ordered by pandID and duplicateID
            $query = "SELECT duplicateID, pandID FROM afbeeldingen WHERE klein = 0 AND volgorde = 0 ORDER BY pandID, duplicateID";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $afbeeldingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $currentPandID = null;
            $volgordeCounter = 1;

            foreach ($afbeeldingen as $afbeelding) {
                $duplicateID = $afbeelding['duplicateID'];
                $pandID = $afbeelding['pandID'];

                // Reset volgordeCounter when pandID changes
                if ($currentPandID !== $pandID) {
                    $currentPandID = $pandID;
                    $volgordeCounter = 1;
                }

                // Update the volgorde for the current afbeelding and its duplicate
                $this->updateAfbeeldingVolgorde($duplicateID, $pandID, $volgordeCounter);

                // Increment volgordeCounter
                $volgordeCounter++;
            }

            // Commit transaction
            $this->db->commit();

            echo "Volgorde updated successfully!";
        } catch (PDOException $e) {
            // Rollback transaction on error
            $this->db->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    private function updateAfbeeldingVolgorde($duplicateID, $pandID, $volgorde) {
        // Update the volgorde for all afbeeldingen with the same duplicateID
        $updateQuery = "UPDATE afbeeldingen SET volgorde = :volgorde WHERE duplicateID = :duplicateID AND pandID = :pandID";
        $updateStmt = $this->db->prepare($updateQuery);
        $updateStmt->bindParam(':volgorde', $volgorde, PDO::PARAM_INT);
        $updateStmt->bindParam(':duplicateID', $duplicateID, PDO::PARAM_INT);
        $updateStmt->bindParam(':pandID', $pandID, PDO::PARAM_INT);
        $updateStmt->execute();
    }
}

// Run the updateVolgorde method
$volgordeUpdater = new VolgordeUpdater();
$volgordeUpdater->updateVolgorde();
