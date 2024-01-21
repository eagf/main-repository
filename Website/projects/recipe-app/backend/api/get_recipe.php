<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
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

if (!isset($_SESSION['userID'])) {
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];

// Get the recipe ID from the URL parameter
$recipeID = isset($_GET['id']) ? $_GET['id'] : null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required']);
}

try {
    // Prepare the query
    $query = 'SELECT r.recipeID, r.recipeName, r.cookingSteps, GROUP_CONCAT(i.ingredientName) as ingredients ' .
             'FROM recipes r ' .
             'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' .
             'LEFT JOIN ingredients i ON ri.ingredientID = i.ingredientID ' .
             'WHERE r.userID = :userID AND r.recipeID = :recipeID ' .
             'GROUP BY r.recipeID';

    // Prepare and execute the query
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        $recipe['ingredients'] = $recipe['ingredients'] ? explode(',', $recipe['ingredients']) : [];
        send_json(200, $recipe);
    } else {
        send_json(404, ['error' => 'Recipe not found']);
    }

} catch (Exception $e) {
    send_json(500, ['error' => $e->getMessage()]);
}

?>
