<?php
//modulesOpzoeken.php

declare(strict_types=1);

require_once 'oef9_1_ModuleLijst.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gegevens ophalen</title>
    </head>
    <body>
        <h1>Zoekresultaat</h1>

        <?php
        $pl = new ModuleLijst();
        $tab = $pl->getLijst();
        ?>
        <ul>
            <?php
            foreach ($tab as $module) {
                print("<li>" . $module . "</li>");
            }
            ?>
        </ul>
    </body>
</html>
