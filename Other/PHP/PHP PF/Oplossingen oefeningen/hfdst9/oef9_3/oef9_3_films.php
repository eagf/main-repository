<?php
//films.php

declare(strict_types=1);

require_once 'oef9_3_FilmLijst.php';

$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] === "new") {
    $filmlijst->createFilm($_POST["titel"], (int) $_POST["duurtijd"]);
}
if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    $filmlijst->deleteFilm((int) $_GET["id"]);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Films</title>
    </head>
    <body>
        <h1>Alle films</h1>

        <?php
        $tab = $filmlijst->getLijst();
        ?>
        <ul>
            <?php
            foreach ($tab as $film) {
                ?>
                <li>
                    <?php print($film->getTitel()); ?>
                    (<?php print($film->getDuurtijd()); ?> min)
                    <a href="oef9_3_films.php?action=delete&id=<?php print($film->getId()); ?>">
                        <img src="oef9_3_img/delete.png" /></a>
                </li>
                <?php
            }
            ?>
        </ul>

        <h1>Film toevoegen</h1>

        <form action="oef9_3_films.php?action=new" method="post">
            Titel : <input type="text" name="titel" /><br /><br />
            Duurtijd : <input type="text" name="duurtijd" /> minuten<br />

            <input type="submit" value="Toevoegen" />
        </form>

    </body>
</html>
