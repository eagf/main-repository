<?php
//casino.php
declare(strict_types=1);
session_start();
class Casino
{
    public function getGokResultaat(int $mijnGok) : int {
        // De functie returnt 0 als het getal
        // gevonden is, 1 als de gok te groot was, en -1 als de
        // gok te klein was.

        if (!isset($_SESSION["teRadenGetal"])) {
            $_SESSION["teRadenGetal"] = rand(1, 5);
        } else {
            $teRadenGetal = $_SESSION["teRadenGetal"];
        }

        if ($mijnGok === $_SESSION["teRadenGetal"]) {
            unset($_SESSION["teRadenGetal"]);
        }

        return $mijnGok <=> $teRadenGetal;
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Casino</title>
</head>

<body>
    <?php
    $gok = (int) $_GET["gok"];
    $casino = new Casino();
    $resultaat = $casino->getGokResultaat($gok);
    if ($resultaat === 0) {
        print("Getal is geraden!");
    } elseif ($resultaat === -1) {
        print("Uw gok is te klein");
    } else {
        print("Uw gok is te groot");
    }
    ?>
    <br> <br>
    <a href="casinoForm.php">Nog eens proberen!</a>
</body>

</html>