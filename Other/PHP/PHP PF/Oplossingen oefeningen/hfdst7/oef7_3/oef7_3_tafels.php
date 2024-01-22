<?php
//tafels.php
declare(strict_types=1);
?>
<!DOCTYPE html>
<!--tafels.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tafels</title>
    </head>
    <body>
        <table border="1">
            <tbody>
                <tr>
                    <td></td>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <td><?php print($i); ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    ?>
                    <tr>
                        <td><?php print($i); ?></td>
                        <?php
                        for ($j = 1; $j <= 10; $j++) {
                            ?>
                            <td><?php print($i * $j); ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
