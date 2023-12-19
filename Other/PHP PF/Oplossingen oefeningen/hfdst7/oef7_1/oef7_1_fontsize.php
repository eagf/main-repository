<?php
//fontsize.php
declare(strict_types=1);
?>
<!DOCTYPE html>
<!--fontsize.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Font size</title>
    </head>
    <body>
        <p style="text-align: center">
            <?php
            for ($i = 1; $i < 7; $i++) {
                ?>
                <span style="font-size: <?php print($i * 10); ?>px">PHP is FANTASTISCH</span><br>
                <?php
            }
            for ($i = 7; $i >= 0; $i--) {
                ?>
                <span style="font-size: <?php print($i * 10); ?>px">PHP is FANTASTISCH</span><br>
                <?php
            }
            ?>
        </p>
    </body>
</html>
