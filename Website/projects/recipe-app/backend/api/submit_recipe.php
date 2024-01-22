<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . getenv('FRONTEND_URL'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, OPTIONS');
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

session_start();
if (!isset($_SESSION['userID'])) {
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];

$recipeName = $_POST['recipeName'] ?? '';
$ingredients = $_POST['ingredients'] ?? [];
$cookingSteps = $_POST['cookingSteps'] ?? '';

if (!$recipeName || !$ingredients || !$cookingSteps) {
    send_json(400, ['error' => 'Recipe name, ingredients and cooking steps are required.']);
    exit;
}

try {
    $db->beginTransaction();

    // Insert recipe into recipes table
    $stmt = $db->prepare('INSERT INTO recipes (recipeName, cookingSteps, userID) VALUES (?, ?, ?)');
    $stmt->execute([$recipeName, $cookingSteps, $userID]);
    $recipeID = $db->lastInsertId();

    // Process each ingredient
    foreach ($ingredients as $index => $ingredient) {
        $stmt = $db->prepare('SELECT ingredientID FROM ingredients WHERE ingredientName = ?');
        $stmt->execute([$ingredient]);
        $existing = $stmt->fetch();

        $ingredientID = $existing ? $existing['ingredientID'] : null;
        if (!$ingredientID) {
            // Ingredient does not exist, insert new ingredient
            $stmt = $db->prepare('INSERT INTO ingredients (ingredientName) VALUES (?)');
            $stmt->execute([$ingredient]);
            $ingredientID = $db->lastInsertId();
        }

        // Link ingredient with the recipe in the junction table
        $stmt = $db->prepare('INSERT INTO recipe_ingredients (recipeID, ingredientID) VALUES (?, ?)');
        $stmt->execute([$recipeID, $ingredientID]);
    }

    $db->commit();
    send_json(200, ['message' => 'Recipe added successfully', 'recipeID' => $recipeID]);

} catch (PDOException $e) {
    $db->rollBack();
    send_json(500, ['error' => $e->getMessage()]);
}


