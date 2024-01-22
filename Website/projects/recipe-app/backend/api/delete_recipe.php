<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . getenv('FRONTEND_URL'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

// Function to send a JSON response
function send_json($status_code, $data) {
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Exit script with a 200 status code (OK)
    send_json(200, []);
}

if (!isset($_SESSION['userID'])) {
    error_log('No session userID found');
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];

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


