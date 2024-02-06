<?php

require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . getenv('FRONTEND_URL'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

function send_json($status_code, $data) {
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
$recipeID = isset($_GET['id']) ? $_GET['id'] : null;

if (!$recipeID) {
    send_json(400, ['error' => 'Recipe ID is required']);
}

try {
    // Updated query with LEFT JOIN on images table
    $query = 'SELECT r.recipeID, r.recipeName, r.cookingSteps, GROUP_CONCAT(i.ingredientName) as ingredients, img.imageURL, img.altText ' .
             'FROM recipes r ' .
             'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' .
             'LEFT JOIN ingredients i ON ri.ingredientID = i.ingredientID ' .
             'LEFT JOIN images img ON r.recipeID = img.recipeID ' . 
             'WHERE r.userID = :userID AND r.recipeID = :recipeID ' .
             'GROUP BY r.recipeID';

    $stmt = $db->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        $recipe['ingredients'] = $recipe['ingredients'] ? explode(',', $recipe['ingredients']) : [];
        $recipe['imagePath'] = $recipe['imageURL'];
        // $recipe['altText'] = $recipe['altText'];
        send_json(200, $recipe);
    } else {
        send_json(404, ['error' => 'Recipe not found']);
    }

} catch (Exception $e) {
    send_json(500, ['error' => $e->getMessage()]);
}

