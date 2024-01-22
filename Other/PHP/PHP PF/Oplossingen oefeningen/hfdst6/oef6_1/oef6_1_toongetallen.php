<?php
//toongetallen.php

declare(strict_types=1);

require_once("oef6_1_GetallenReeksMaker.php");
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Getallenreeks</title>
    </head>
    <body>
        <?php
        $getallenReeksMaker = new GetallenReeksMaker();
        $tabel = $getallenReeksMaker->getReeks();
        ?>
        
        <table border="1">
            <tbody>
                <?php
                foreach ($tabel as $getal) {
                    ?>
                    <tr>
                        <td>
                            <?php print($getal); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </body>
</html>
