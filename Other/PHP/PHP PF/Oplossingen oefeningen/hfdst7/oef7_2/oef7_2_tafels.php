<?php
//tafels.php
declare(strict_types=1);
$grondtal = $_GET["grondtal"];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tafels</title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th colspan="2">De tafel van <?php print($grondtal); ?></th>
                </tr>
            </thead
            <tbody>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    ?>
                    <tr>
                        <td style="text-align: right;">
                            <?php print($i); ?> maal <?php print($grondtal); ?>&nbsp;
                        </td>
                        <td>&nbsp;<?php print($i * $grondtal); ?>&nbsp;</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
