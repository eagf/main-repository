<?php
//FilmLijst.php 
declare(strict_types=1);
require_once("FilmLijst.php");

$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] === "new") {
    $filmlijst->addFilm($_POST["titel"], (int)$_POST["duurtijd"]);
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Modules opzoeken</title>
</head>

<body>
    <h1>Alle films</h1>
    <?php
    $tab = $filmlijst->getLijst()
    ?>
    <ul>
        <?php
            foreach ($tab as $item) { 
                print("<li>" . $item . "</li>"); 
            }
        ?>
    </ul>
    <h1>Film toevoegen</h1>
    <form action="films.php?action=new" method="post">
        Titel: <input type="text" name="titel">  <br><br>
        Duurtijd: <input type="text" name="duurtijd"> minuten <br>
        <input type="submit" value="OK">
    </form>
</body>

</html>