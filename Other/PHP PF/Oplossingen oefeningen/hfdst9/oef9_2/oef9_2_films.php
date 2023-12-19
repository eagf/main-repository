<?php
//films.php

declare(strict_types=1);

require_once 'oef9_2_FilmLijst.php';

$filmlijst = new FilmLijst();
if (isset($_GET["action"]) && $_GET["action"] === "new") {
    $filmlijst->createFilm($_POST["titel"], (int) $_POST["duurtijd"]);
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gegevens toevoegen</title>
    </head>
    <body>
        <h1>Alle films</h1>

        <?php
        $tab = $filmlijst->getLijst();
        ?>
        <ul>
            <?php
            foreach ($tab as $film) {
                print("<li>" . $film . "</li>");
            }
            ?>
        </ul>

        <h1>Film toevoegen</h1>

        <form action="oef9_2_films.php?action=new" method="post">
            Titel : <input type="text" name="titel" /><br /><br />
            Duurtijd : <input type="text" name="duurtijd" /> minuten<br />

<!--        Titel : <input type="text" name="titel" required="required" /><br /><br />
            Duurtijd : <input type="number" name="duurtijd" min="1" required="required" /> minuten<br />-->

            <input type="submit" value="Toevoegen" />
        </form>

    </body>
</html>
