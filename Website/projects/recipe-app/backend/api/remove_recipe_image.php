<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . getenv('FRONTEND_URL'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

function send_json($status_code, $data)
{
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    send_json(200, []);
}

$recipeID = $_POST['id'] ?? null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required.']);
    exit;
}

try {
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

    send_json(200, ['message' => 'Image removed successfully.']);
} catch (PDOException $e) {
    send_json(500, ['error' => $e->getMessage()]);
}
