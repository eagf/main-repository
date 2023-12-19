<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/nieuwExemplaarForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Invoeren nieuw exemplaar</title>
</head>

<body>
    <h1>Invoeren nieuw exemplaar</h1>
    <form method="post" action="invoerenNieuwExemplaar.php?action=process">
        Film:
        <select name="selFilm">
            <?php foreach ($filmLijst as $film) {

                ?>
                <option value="<?php print($film->getId()); ?>"> <?php print($film->getTitel()); ?>
                </option>
            <?php } ?>
            </select><br><br>
            Nummer van het nieuwe exemplaar: <input type="number" name="exemplaarNummer"><br><br>
            <input type="submit" value="Toevoegen"> 
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "toegevoegd")) {
        ?>
        <p style="color:green">Het exemplaar van de film is correct toegevoegd.</p>
        <?php
    }
    if (isset($_GET["error"]) && ($_GET["error"] === "nummerbestaat")) {
        ?>
        <p style="color:red">Het opgegeven exemplaarnummer bestaat al.</p>
    <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>