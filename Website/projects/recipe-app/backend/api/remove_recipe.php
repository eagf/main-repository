<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
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
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];

// Read data from the request body
$data = json_decode(file_get_contents("php://input"), true);
$recipeID = $data['id'] ?? null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required']);
    exit;
}

try {
    $stmt = $db->prepare('SELECT removed FROM recipes WHERE recipeID = :recipeID AND userID = :userID');
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        send_json(404, ['error' => 'Recipe not found']);
        exit;
    }

    // Toggle the removed status
    $newRemovedStatus = $recipe['removed'] == 0 ? 1 : 0;

    $stmt = $db->prepare('UPDATE recipes SET removed = :removed WHERE recipeID = :recipeID AND userID = :userID');
    $stmt->bindParam(':removed', $newRemovedStatus, PDO::PARAM_INT);
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    send_json(200, ['message' => 'Recipe removed status toggled successfully', 'newRemovedStatus' => $newRemovedStatus]);

} catch (PDOException $e) {
    send_json(500, ['error' => $e->getMessage()]);
}

?>
