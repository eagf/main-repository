// backend/api/logout.php

<?php

session_start();

header('Access-Control-Allow-Origin: http://localhost:3000'); // Allow requests from your React app domain
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Make sure to include OPTIONS
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

// Destroy the session
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}

// Clear the client-side token if you set one in cookies
if (isset($_SESSION['userID'])) {
    unset($_SESSION['userID']);
}

send_json(200, ['message' => 'Logged out successfully']);
?>
