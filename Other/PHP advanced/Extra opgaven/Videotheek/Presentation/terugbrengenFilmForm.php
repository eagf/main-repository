<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/terugbrengenFilmForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Terugbrengen film</title>
</head>

<body>
    <h1>Terugbrengen film</h1>
    <form method="post" action="terugbrengenFilm.php?action=process">
        Exemplaar: <input type="number" name="nummer"><br><br>
        <input type="submit" value="Huren">
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "teruggebracht")) {
        ?>
        <p style="color:green">Het exemplaar is nu teruggebracht.</p>
    <?php }
    if (isset($_GET["error"]) && ($_GET["error"] === "nummerBestaatNiet")) {
        ?>
        <p style="color:red">Het opgegeven exemplaar bestaat niet.</p>
    <?php }
    if (isset($_GET["error"]) && ($_GET["error"] === "nummerIsAlTeruggebracht")) {
        ?>
        <p style="color:red">Het opgegeven exemplaar is al teruggebracht.</p>
    <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>