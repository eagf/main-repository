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

if (!isset($_SESSION['userID'])) {
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];
$recipeID = $_POST['id'] ?? null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required']);
    exit;
}

try {
    $stmt = $db->prepare('UPDATE recipes SET removed = 0 WHERE recipeID = :recipeID AND userID = :userID');
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();

    send_json(200, ['message' => 'Recipe restored successfully']);
} catch (PDOException $e) {
    send_json(500, ['error' => $e->getMessage()]);
}


