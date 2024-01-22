<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/nieuweTitelForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Invoeren nieuwe titel</title>
</head>

<body>
    <h1>Invoeren nieuwe titel</h1>
    <form method="post" action="invoerenNieuweTitel.php?action=process">
        Titel van de nieuwe film: <input type="text" name="txtTitel"> </td>
        <input type="submit" value="Toevoegen" /> </td>
    </form>
    <?php
    if (isset($_GET["action"]) && ($_GET["action"] === "toegevoegd")) {
        ?>
        <p style="color:green">De titel van de film is correct toegevoegd.</p>
        <?php
    } 
    if (isset($_GET["error"]) && ($_GET["error"] === "titelbestaat")) {
        ?>
        <p style="color:red">De opgegeven titel bestaat al</p>
        <?php
    } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>