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

// Get the raw POST data
$rawData = file_get_contents("php://input");
// Decode the JSON data into a PHP array
$data = json_decode($rawData, true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (!$email || !$password) {
    send_json(400, ['error' => 'Email and password are required']);
}

try {
    // Fetch the user from the database using the provided email
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
        send_json(401, ['error' => 'Invalid email or password']);
    }

    // Compare the provided password with the stored hashed password
    $validPassword = password_verify($password, $user['password']);

    if ($validPassword) {
        $sessionToken = $user['userID'];
        $_SESSION['userID'] = $sessionToken;
        send_json(200, ['message' => 'Logged in successfully', 'sessionToken' => $sessionToken]);
    } else {
        send_json(401, ['error' => 'Invalid email or password']);
    }
    
} catch (Exception $e) {
    send_json(500, ['error' => $e->getMessage()]);
}


