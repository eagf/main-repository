<?php

require_once __DIR__ . '/../config.php';

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

// Access the fields directly from $_POST and $_FILES
$recipeID = $_POST['id'] ?? null;
$recipeName = $_POST['recipeName'] ?? null;
$ingredients = isset($_POST['ingredients']) ? json_decode($_POST['ingredients'], true) : null; // assuming ingredients is sent as a JSON string
$cookingSteps = $_POST['cookingSteps'] ?? null;
$recipeImage = $_FILES['recipeImage'] ?? null; // Accessing file upload

if (!$recipeID || !$recipeName || !$ingredients || !$cookingSteps) {
    send_json(400, ['error' => 'Recipe ID, name, ingredients and cooking steps are required.']);
    exit;
}

// Validate required fields
if (!$recipeID || !$recipeName || !is_array($ingredients) || !$cookingSteps) {
    send_json(400, ['error' => 'Recipe ID, name, ingredients, and cooking steps are required.']);
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

    // Handling the image upload
    if (isset($_FILES['recipeImage']) && $_FILES['recipeImage']['error'] == UPLOAD_ERR_OK) {
        $targetDirectory = __DIR__ . '/../assets/recipeImages/'; // Corrected directory path
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true); // Ensure directory exists
        }
        $fileName = basename($_FILES['recipeImage']['name']);
        $targetFile = $targetDirectory . $fileName;
    
        if (move_uploaded_file($_FILES['recipeImage']['tmp_name'], $targetFile)) {
            $imageURL = 'assets/recipeImages/' . $fileName; 
            $altText = 'Image for ' . $recipeName;

            $stmt = $db->prepare('INSERT INTO images (recipeID, imageURL, altText) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE imageURL = ?, altText = ?');
            $stmt->execute([$recipeID, $imageURL, $altText, $imageURL, $altText]);

            error_log("Image moved successfully");
            send_json(200, ['message' => 'Recipe updated successfully', 'imagePath' => $imageURL, 'altText' => $altText]);
        } else {
            error_log("Failed to move uploaded file.");
            send_json(500, ['error' => 'Failed to move uploaded file.']);
        }
    } else {
        error_log("File upload error: " . $_FILES['recipeImage']['error']);
        send_json(400, ['error' => 'File upload error.']);
    }


    // Commit transaction
    $db->commit();
    send_json(200, ['message' => 'Recipe updated successfully']);
} catch (PDOException $e) {
    // Rollback transaction in case of error
    $db->rollBack();
    send_json(500, ['error' => $e->getMessage()]);
}
