<?php
//lucifers.php

declare(strict_types=1);

session_start();

if (isset($_GET["reset"]) && $_GET["reset"] === "1") {
    unset($_SESSION["aantalLucifers"]);
}

if (!isset($_SESSION["aantalLucifers"])) {
    $_SESSION["aantalLucifers"] = 7;
}

if (isset($_GET["aantal"])) {
    $aantal = $_GET["aantal"];
}

$spelstop = false;
if (isset($aantal)) {
    if ($_SESSION["aantalLucifers"] - $aantal > 0) {
        $_SESSION["aantalLucifers"] -= $aantal;
        
    } elseif ((int) $_SESSION["aantalLucifers"] - (int) $aantal === (int) 0) {
        $spelstop = true;
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lucifers</title>
    </head>
    <body>
        <h1>Luciferspel</h1>

        <?php
        if ($spelstop) {
            ?>
            <h2>Het spel is afgelopen.</h2>
            <?php
        } else {
            for ($i = 1; $i <= $_SESSION["aantalLucifers"]; $i++) {
                ?>
            <img src="oef7_6_img/lucifer.png" alt="lucifer" />
                <?php
            }
            ?>
            <br /><br />
            
            <table>
                <tr>
                    <td>
                        <form action="oef7_6_lucifers.php?aantal=1" method="post">
                            <input type="submit" value="Eén lucifer wegnemen" />
                        </form>
                    </td>
                    <td>
                        <form action="oef7_6_lucifers.php?aantal=2" method="post">
                            <input type="submit" value="Twee lucifers wegnemen" />
                        </form>
                    </td>
                </tr>
            </table>
            <?php
        }
        ?>
        <br />
        <p>
            Klik <a href="oef7_6_lucifers.php?reset=1">hier</a> om een nieuw spel te beginnen.
        </p>
    </body>
</html>
