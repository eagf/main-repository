// backend/api/get_recipes.php

<?php

require_once __DIR__ . '/../config.php';
session_start(); // Start or resume the session

header('Content-Type: application/json');

// Function to send a JSON response
function send_json($status_code, $data) {
    http_response_code($status_code);
    echo json_encode($data);
    exit;
}

if (!isset($_SESSION['userID'])) {
    // User is not logged in
    send_json(401, ['error' => 'Unauthorized access. Please login.']);
    exit;
}

$userID = $_SESSION['userID']; // Get the user ID from the session

try {
    // Get search term if any
    $searchTerm = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';

    // Build the query
    $query = 'SELECT r.recipeID, r.recipeName, r.cookingSteps, GROUP_CONCAT(i.ingredientName) as ingredients ' .
             'FROM recipes r ' .
             'LEFT JOIN recipe_ingredients ri ON r.recipeID = ri.recipeID ' .
             'LEFT JOIN ingredients i ON ri.ingredientID = i.ingredientID ' .
             'WHERE r.userID = :userID ';

    if ($searchTerm !== '') {
        $query .= 'AND LOWER(i.ingredientName) = LOWER(:searchTerm) ';
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
    $formattedRecipes = array_map(function($recipe) {
        $recipe['ingredients'] = $recipe['ingredients'] ? explode(',', $recipe['ingredients']) : [];
        return $recipe;
    }, $recipes);

    // Send the response
    send_json(200, $formattedRecipes);

} catch (Exception $e) {
    send_json(500, ['error' => $e->getMessage()]);
}

?>
