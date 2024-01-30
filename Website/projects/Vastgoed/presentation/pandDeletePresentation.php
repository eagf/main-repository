<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/logo.ico">
    <title>Select Pand to Delete</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="form-container">
            <?php if (isset($message)) {
                echo "<p class='success'>" . $message . "</p>";
            } ?>
            <h2>Selecteer het pand om te verwijderen</h2>
            <h3>De eerste 5 voorbeelden zijn nog niet te verwijderen</h3>
            <form action="pandDelete.php" method="POST">
                <label for="pandID">Selecteer een pand:</label>
                <select id="pandID" name="pandID">
                    <?php getPandenSelect(); ?>
                </select>
                <br>
                <button type="submit">Verwijder</button>
            </form>
        </div>


    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>