<?php
declare(strict_types=1);
session_start();
$aantalDeuren = 7;

if (isset($_GET["reset"]) && $_GET["reset"] === "1" ) {
    unset($_SESSION["juisteDeur"]);
    unset($_SESSION["deuren"]);
    unset($_SESSION["hoera"]);
}

if (!isset($_SESSION["juisteDeur"])) {
    $_SESSION["juisteDeur"] = rand(1,$aantalDeuren);
}
if (!isset($_SESSION["deuren"])) {
    $_SESSION["deuren"] = array();
    for ($i = 0; $i < $aantalDeuren; $i++) {
        $_SESSION["deuren"][$i] = 0;
    }
}

if (isset($_GET["gekozenDeur"])) {

    if ((int)$_GET["gekozenDeur"] === (int)$_SESSION["juisteDeur"]) {
        $_SESSION["deuren"][$_GET["gekozenDeur"] - 1] = 2;
    }
    else {
        $_SESSION["deuren"][$_GET["gekozenDeur"] - 1] = 1;
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Schattenjacht</title>
    </head>
    <body>
        <h1> 
            Kies een deur
        </h1>
        <span>
            <?php
            for ((int)$gekozenDeur = 1 ; $gekozenDeur <= $aantalDeuren ; $gekozenDeur++) {
                
                print("<a href='schattenjacht.php?gekozenDeur=$gekozenDeur'>");
                
                if ($_SESSION["deuren"][$gekozenDeur - 1] === 0 ) {
                    print("<img src='doorclosed.png'></a>");
                }
                elseif ($_SESSION["deuren"][$gekozenDeur - 1] === 1 ) {
                    print("<img src='dooropen.png'></a>");
                }
                elseif ($_SESSION["deuren"][$gekozenDeur - 1] === 2 ){
                    print("<img src='doortreasure.png'></a>");
                    $_SESSION["hoera"] = "";
                }
            } 
            ?>
        </span>
        <p> 
            Klik 
            <a href="schattenjacht.php?reset=1">hier</a>
            om een nieuw spel te beginnen.
        </p>
        <p> 
            <?php 
            if (isset($_SESSION["hoera"])) {
                print("<br><br>");
                print("<img src='hoera.gif'>");
            }
            ?>
        </p>
    </body>
</html>
