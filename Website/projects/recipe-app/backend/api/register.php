// backend/api/register.php

<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
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

// Get the raw POST data
$rawData = file_get_contents("php://input");
// Decode the JSON data into a PHP array
$data = json_decode($rawData, true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';
$name = $data['name'] ?? '';

if (!$email || !$name || !$password) {
    send_json(400, ['error' => 'Email, name, and password are required']);
}

try {
    // Check if the user already exists
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingUsers = $stmt->fetchAll();

    if (count($existingUsers) > 0) {
        send_json(400, ['error' => 'User already exists']);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $db->prepare('INSERT INTO users (email, name, password) VALUES (:email, :name, :password)');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        send_json(201, ['message' => 'User registered successfully']);
    } else {
        send_json(500, ['error' => 'Error registering user']);
    }
} catch (Exception $e) {
    send_json(500, ['error' => $e->getMessage()]);
}

?>
