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

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$recipeID = $data['id'] ?? null;
$recipeName = $data['recipeName'] ?? null;
$ingredients = $data['ingredients'] ?? [];
$cookingSteps = $data['cookingSteps'] ?? null;

if (!$recipeID || !$recipeName || !$ingredients || !$cookingSteps) {
    send_json(400, ['error' => 'Recipe ID, name, ingredients and cooking steps are required.']);
    exit;
}

try {
    // Start transaction
    $db->beginTransaction();

    // Update the recipe
    $stmt = $db->prepare('UPDATE recipes SET recipeName = ?, cookingSteps = ? WHERE recipeID = ? AND userID = ?');
    $stmt->execute([$recipeName, $cookingSteps, $recipeID, $userID]);

    // Remove existing ingredient associations
    $stmt = $db->prepare('DELETE FROM recipe_ingredients WHERE recipeID = ?');
    $stmt->execute([$recipeID]);

    // Process each ingredient
    foreach ($ingredients as $ingredientName) {
        // Check if the ingredient already exists
        $stmt = $db->prepare('SELECT ingredientID FROM ingredients WHERE ingredientName = ?');
        $stmt->execute([$ingredientName]);
        $existingIngredient = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingIngredient) {
            // Ingredient exists, use its ID
            $ingredientID = $existingIngredient['ingredientID'];
        } else {
            // Ingredient does not exist, insert new ingredient
            $stmt = $db->prepare('INSERT INTO ingredients (ingredientName) VALUES (?)');
            $stmt->execute([$ingredientName]);
            $ingredientID = $db->lastInsertId();
        }

        // Link ingredient with the recipe in the junction table
        $stmt = $db->prepare('INSERT INTO recipe_ingredients (recipeID, ingredientID) VALUES (?, ?)');
        $stmt->execute([$recipeID, $ingredientID]);
    }

    // Commit transaction
    $db->commit();
    send_json(200, ['message' => 'Recipe updated successfully']);
} catch (PDOException $e) {
    // Rollback transaction in case of error
    $db->rollBack();
    send_json(500, ['error' => $e->getMessage()]);
}



