<!DOCTYPE html>
<!--fibonacci.php-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fibonacci</title>
    </head>
    <body>
        <?php
        $oud = 0;
        $nieuw = 1;
        print($oud . " ");
        
        while ($nieuw < 5000) {
            print($nieuw . " ");
            
            $vorigOud = $oud;
            $oud = $nieuw;
            $nieuw = $vorigOud + $oud;
        }
        ?>
    </body>
</html>
