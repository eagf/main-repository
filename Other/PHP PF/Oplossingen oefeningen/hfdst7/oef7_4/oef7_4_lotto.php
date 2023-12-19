<?php
//lotto.php
declare(strict_types=1);

require_once 'oef7_4_GetallenKiezer.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lotto</title>
    </head>
    <body>
        <h1>De winnende lotto-getallen :</h1>
        <table border="1">
            <tbody>
                <?php
                $kiezer = new GetallenKiezer();
                $reeks = $kiezer->getGetallenReeks();
                
                for ($i = 1; $i <= 42; $i++) {
                    if (in_array($i, $reeks)) {
                        $bgcolor = "#aaa";
                    } else {
                        $bgcolor = "#eee";
                    }
                    
                    if ($i % 7 === 1) {
                        print("<tr>");
                    }
                    
                    print("<td style='text-align: center; background-color: " . $bgcolor . "'>" . $i . "</td>");
                    
                    if ($i % 7 === 0) {
                        print("</tr>");
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
