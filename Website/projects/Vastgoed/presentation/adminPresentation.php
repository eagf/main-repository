<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/logo.ico">
    <title>Toevoegen</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="form-container">

            <form action="pandInput.php" method="POST">
                <button type="submit">Pand toevoegen</button>
            </form>
            <form action="pandDelete.php" method="POST">
                <button type="submit">Pand verwijderen</button>
            </form>
            <form action="images.php" method="POST">
                <button type="submit">Afbeeldingen</button>
            </form>

        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</body>

</html>