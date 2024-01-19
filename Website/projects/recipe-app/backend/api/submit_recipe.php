// backend/api/submit_recipe.php

<?php

require_once __DIR__ . '/../config.php';

session_start();

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

if (!isset($_SESSION['userID'])) {
    // User is not logged in
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID']; // Get the user ID from the session

$recipeName = $_POST['recipeName'] ?? '';
$ingredients = $_POST['ingredients'] ?? [];
$cookingSteps = $_POST['cookingSteps'] ?? '';

if (!$recipeName || !$ingredients || !$cookingSteps) {
    send_json(400, ['error' => 'Recipe name, ingredients and cooking steps are required.']);
}

try {
    // Insert recipe into recipes table
    $stmt = $db->prepare('INSERT INTO recipes (recipeName, cookingSteps, userID) VALUES (?, ?, ?)');
    $stmt->execute([$recipeName, $cookingSteps, $userID]);
    $recipeID = $db->lastInsertId();

    // Process each ingredient
    foreach ($ingredients as $ingredient) {
        $stmt = $db->prepare('SELECT ingredientID FROM ingredients WHERE ingredientName = ?');
        $stmt->execute([$ingredient]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Ingredient exists, use its ID
            $ingredientID = $existing['ingredientID'];
        } else {
            // Ingredient does not exist, insert new ingredient
            $stmt = $db->prepare('INSERT INTO ingredients (ingredientName) VALUES (?)');
            $stmt->execute([$ingredient]);
            $ingredientID = $db->lastInsertId();
        }

        // Link ingredient with the recipe in the junction table
        $stmt = $db->prepare('INSERT INTO recipe_ingredients (recipeID, ingredientID) VALUES (?, ?)');
        $stmt->execute([$recipeID, $ingredientID]);
    }

    send_json(200, ['message' => 'Recipe added successfully']);
} catch (PDOException $e) {
    send_json(500, ['error' => $e->getMessage()]);
}
?>
