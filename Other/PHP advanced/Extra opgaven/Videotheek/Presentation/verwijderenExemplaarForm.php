<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/verwijderenExemplaar -->
<html>

<head>
    <meta charset=utf-8>
    <title>Verwijderen exemplaar</title>
</head>

<body>
    <h1>Verwijderen exemplaar</h1>
    <form method="post" action="verwijderenExemplaar.php?action=process">
        Exemplaar:
        <select name="selExemplaar">
            <?php foreach ($exemplarenLijst as $exemplaar) {

                ?>
                <option value="<?php print($exemplaar->getId()); ?>"> <?php print($exemplaar->getId()); ?>
                </option>
            <?php } ?>
        </select><br><br>
        <input type="submit" value="Verwijderen">
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "verwijderd")) {
        ?>
        <p style="color:green">Het exemplaar is succesvol verwijderd.</p>
    <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>