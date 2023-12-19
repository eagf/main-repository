<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/verwijderenTitelForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Verwijderen titel</title>
</head>

<body>
    <h1>Verwijderen titel</h1>
    <form method="post" action="verwijderenTitel.php?action=process">
        Film:
        <select name="selFilm">
            <?php foreach ($filmLijst as $film) {

                ?>
                <option value="<?php print($film->getId()); ?>"> <?php print($film->getTitel()); ?>
                </option>
            <?php } ?>
            </select><br><br>
            <input type="submit" value="Verwijderen">
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "verwijderd")) {
        ?>
        <p style="color:green">De film en alle exemplaren ervan zijn succesvol verwijderd.</p>
        <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>