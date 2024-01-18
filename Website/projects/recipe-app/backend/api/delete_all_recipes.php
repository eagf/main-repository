// backend/api/delete_all_recipes.php

<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Function to send a JSON response
function send_json($status_code, $data) {
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

// For demonstration, setting a fixed user ID.
// In practice, you would get this from session or another method of user identification.
$userID = 1; // Replace with actual user ID determination logic.

try {
    // Start transaction
    $db->beginTransaction();

    // First delete entries from the recipe_ingredients table
    $stmt = $db->prepare('DELETE ri FROM recipe_ingredients ri JOIN recipes r ON ri.recipeID = r.recipeID WHERE r.userID = :userID');
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Then delete from recipes table
    $stmt = $db->prepare('DELETE FROM recipes WHERE userID = :userID');
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Commit transaction
    $db->commit();

    send_json(200, ['message' => 'All recipes deleted successfully']);

} catch (Exception $e) {
    // Rollback transaction
    $db->rollBack();

    send_json(500, ['error' => $e->getMessage()]);
}

?>
