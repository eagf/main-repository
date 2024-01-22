<?php
//cookies.php
declare(strict_types=1);
if (!empty($_POST["txtNaam"])) {
    setcookie("ingevuldeNaam", $_POST["txtNaam"], time() + 120);
    $naam = $_POST["txtNaam"];
} else {
    $naam = "";
    if (isset($_COOKIE["ingevuldeNaam"])) {
        $naam = $_COOKIE["ingevuldeNaam"];
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Cookies</title>
</head>

<body>
    <?php if (!empty($naam)) {
        print("Welkom, ") . $naam;
    } ?>
    <form action="cookies.php" method="post">
        Uw naam: <input type="text" name="txtNaam" value="<?php print($naam); ?>" />
        <input type="submit" value="Versturen" />
    </form>
    <br>
    <a href="cookies.php">Vernieuw de pagina</a>
</body>

</html>