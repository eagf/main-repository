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
    error_log('No session userID found');
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID'];

try {
    // Get search term if any
    $searchTerm = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';

    // Build the query
    $query = 'SELECT r.recipeID, r.recipeName, r.cookingSteps, r.removed, i.imageURL, i.altText, GROUP_CONCAT(ing.ingredientName) as ingredients ' .
        'FROM recipes r ' .
        'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' .
        'LEFT JOIN ingredients ing ON ri.ingredientID = ing.ingredientID ' .
        'LEFT JOIN images i ON r.recipeID = i.recipeID ' . 
        'WHERE r.userID = :userID AND r.removed = 0 ';

    if ($searchTerm !== '') {
        $query .= 'AND LOWER(ing.ingredientName) LIKE LOWER(:searchTerm) ';
        $searchTerm = '%' . $searchTerm . '%';
    }

    $query .= 'GROUP BY r.recipeID';

    // Prepare and execute the query
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userID', $userID);
    if ($searchTerm !== '') {
        $stmt->bindParam(':searchTerm', $searchTerm);
    }
    $stmt->execute();
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format the recipes
    $formattedRecipes = array_map(function ($recipe) {
        $recipe['ingredients'] = $recipe['ingredients'] ? explode(',', $recipe['ingredients']) : [];
        $recipe['imagePath'] = $recipe['imageURL'];
        // $recipe['altText'] = $recipe['altText'];
        return $recipe;
    }, $recipes);

    // Send the response
    send_json(200, $formattedRecipes);
} catch (Exception $e) {
    var_dump('Constructed query: ' . $query);
    send_json(500, ['error' => $e->getMessage()]);
}
