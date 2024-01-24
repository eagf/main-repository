<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/pandInput.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <title>Select Pand to Delete</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php if (isset($message)) { 
        echo "<p class='success'>".$message."</p>";
     } ?>
    <h2>Select Pand to Delete</h2>
    <form action="pandDelete.php" method="GET">
        <label for="pandID">Select a Pand:</label>
        <select id="pandID" name="pandID">
            <?php getPandenSelect(); ?>
        </select>
        <br>
        <button type="submit">Delete Selected Pand</button>
    </form>
</body>

</html>