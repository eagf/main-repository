// backend/api/delete_recipe.php

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

// Get the recipe ID from the URL parameter
$recipeID = isset($_GET['id']) ? $_GET['id'] : null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required']);
}

try {
    // Start transaction
    $db->beginTransaction();

    // Delete from recipe_ingredients table
    $stmt = $db->prepare('DELETE FROM recipe_ingredients WHERE recipeID = :recipeID');
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();

    // Delete from recipes table
    $stmt = $db->prepare('DELETE FROM recipes WHERE recipeID = :recipeID AND userID = :userID');
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    // Commit transaction
    $db->commit();

    send_json(200, ['message' => 'Recipe deleted successfully']);

} catch (Exception $e) {
    // Rollback transaction
    $db->rollBack();

    send_json(500, ['error' => $e->getMessage()]);
}

?>
