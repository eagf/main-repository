<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/hurenFilmForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Huren film</title>
</head>

<body>
    <h1>Huren film</h1>
    <form method="post" action="hurenFilm.php?action=process">
        Exemplaar: <input type="number" name="nummer"><br><br>
        <input type="submit" value="Huren">
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "verhuurd")) {
        ?>
        <p style="color:green">Het exemplaar wordt nu verhuurd.</p>
    <?php }
    if (isset($_GET["error"]) && ($_GET["error"] === "nummerBestaatNiet")) {
        ?>
        <p style="color:red">Het opgegeven exemplaar bestaat niet.</p>
    <?php }
    if (isset($_GET["error"]) && ($_GET["error"] === "nummerIsAlVerhuurd")) {
        ?>
        <p style="color:red">Het opgegeven exemplaar is al verhuurd.</p>
    <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>