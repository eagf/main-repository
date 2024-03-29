<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . getenv('FRONTEND_URL'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

function send_json($status_code, $data) {
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
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
    send_json(400, ['error' => 'Recipe ID is required.']);
    exit;
}

try {
    $db->beginTransaction();

    // Retrieve the image URL from the database
    $stmt = $db->prepare('SELECT imageURL FROM images WHERE recipeID = ?');
    $stmt->execute([$recipeID]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image && file_exists(__DIR__ . "/.." . $image['imageURL'])) {
        // Delete the image file
        unlink(__DIR__ . "/.." . $image['imageURL']);
    }

    // Remove the image record from the database
    $stmt = $db->prepare('DELETE FROM images WHERE recipeID = ?');
    $stmt->execute([$recipeID]);

    // Remove the recipe record from the database
    $stmt = $db->prepare('DELETE FROM recipes WHERE recipeID = ? AND userID = ?');
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    $db->commit();
    send_json(200, ['message' => 'Recipe and associated image removed successfully.']);
} catch (PDOException $e) {
    $db->rollBack();
    send_json(500, ['error' => $e->getMessage()]);
}
