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

try {
    if (!isset($_SESSION["userID"])) {
        send_json(401, ['error' => 'User not logged in']);
    }

    // Destroy the session and clear the session data
    unset($_SESSION["userID"]);
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session

    send_json(200, ['message' => 'Logged out successfully']);

} catch (Exception $e) {
    send_json(500, ['error' => 'An error occurred while logging out: ' . $e->getMessage()]);
}


