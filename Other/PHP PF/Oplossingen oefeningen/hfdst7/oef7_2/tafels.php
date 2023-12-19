<?php
//tafels.php
declare(strict_types=1);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Tafels</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th colspan="2">De tafel van <?php print($_GET["gekozenGrondgetal"]) ?></th>
            </tr>
            <?php for ($i = 1; $i < 11; $i++) { ?>
                <tr>
                    <td>
                        <?php print($i)?> maal <?php print($_GET["gekozenGrondgetal"])?>
                    </td>
        
                    <td>
                        <?php print($i * $_GET["gekozenGrondgetal"]) ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
