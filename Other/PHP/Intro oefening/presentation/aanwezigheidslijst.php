<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!--presentation/aanwezigheidslijst.php-->
<html>

<head>
    <meta charset=utf-8>
    <title>Aanwezigheidslijst cursisten</title>
</head>

<body>
    <h1>Aanwezigheidslijst</h1> Aanwezigheden op: <?php echo date("d/m/Y"); ?> <br> <br> Vink aan indien aanwezig: <br>
    <form action="aanwezighedendoorgeven.php" method="post">
        <ul>
            <?php
            foreach ($aanwezigheden as $aanwezigheid) {
            ?>
                <li>
                    <?php print($aanwezigheid->getCursist()->getFamilienaam() . ", " . $aanwezigheid->getCursist()->getVoornaam());
                    ?>
                    <input type="checkbox" name="aanwezig[]" value="<?php echo $aanwezigheid->getCursist()->getId() ?>" />
                </li>
            <?php
            }
            ?>
        </ul>
        <input type="submit" value="aanwezigheden doorgeven">
    </form>
</body>

</html>