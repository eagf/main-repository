<?php
//FilmLijst.php 
declare(strict_types=1);
require_once("FilmLijst.php");

$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] === "add") {
    $filmlijst->addFilm($_POST["titel"], (int)$_POST["duurtijd"]);
};
if (isset($_GET["action"]) && $_GET["action"] === "remove") {
    $filmlijst->removeFilm((int)$_GET["id"]);
};
$tab = $filmlijst->getLijst();
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Films</title>
</head>

<body>
    <h1>Alle films</h1>
    <ul>
        <?php
        foreach ($tab as $film) {
            print("<li>" . (string)$film->getTitel() . " (" . (int)$film->getDuurtijd() . " min)" . "<a href='films.php?action=remove&id=" . (int)$film->getId() . "'><img src='oef9_3_img/delete.png'></a></li>");
        } 
        ?>
    </ul>
    <h1>Film toevoegen</h1>
    <form action="films.php?action=add" method="post">
        Titel: <input type="text" name="titel">  <br><br>
        Duurtijd: <input type="text" name="duurtijd"> minuten <br>
        <input type="submit" value="Toevoegen">
    </form>
</body>

</html>