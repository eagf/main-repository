<?php
//filmBewerken.php

declare(strict_types=1);

require_once("oef9_4_FilmLijst.php");

$updated = false;
if (isset($_GET["action"]) && $_GET["action"] === "verwerk") {
    $film = new Film((int) $_GET["id"], $_POST["titel"],(int) $_POST["duurtijd"]);
    $filmLijst = new FilmLijst();
    $filmLijst->updateFilm($film);
    $updated = true;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Film bewerken</title>
    </head>
    <body>

        <h1>Film bewerken</h1>

        <?php
        if ($updated) {
            print("Record bijgewerkt!");
        }
        
        $filmLijst = new FilmLijst();
        $film = $filmLijst->getFilmById((int) $_GET["id"]);
        ?>
        
        <form action="oef9_4_filmBewerken.php?action=verwerk&id=<?php print($_GET["id"]); ?>" method="post">
            Titel:
            <input type="text" name="titel" value="<?php print($film->getTitel()); ?>" /> <br /><br />
            Duurtijd:
            <input type="text" name="duurtijd" value="<?php print($film->getDuurtijd()); ?>" /> min <br />
            <input type="submit" value="Opslaan" />
        </form>
        <br />
        <a href="oef9_4_films.php">Terug naar overzicht</a>
        
    </body>
</html>
