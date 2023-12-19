<?php

declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/overzichtFilms.php -->
<html>

<head>
    <meta charset=utf-8>
    <title>Overzicht</title>
    <style>
        table {
            border-collapse: collapse;
            table-layout: auto;
        }
        td, th {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
            height: 25px;
            vertical-align: top;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1>Overzicht Films</h1>
    <table>
        <tr>
            <th style="width:350px">Titel</th>
            <th>Nummer(s)</th>
            <th>Exemplaren aanwezig</th>
        </tr>
        <?php foreach ($filmLijst as $film) { ?>
            <tr>
                <td>
                    <?php echo $film->getTitel(); ?>
                </td>
                <td>
                    <?php
                    $exemplarenLijst = $filmSvc->getExemplarenByFilmId($film->getId());
                    foreach ($exemplarenLijst as $exemplaar) {
                        $exemplaarId = $exemplaar->getId();
                        if ($exemplaar->getAanwezig() == 0) {
                            echo $exemplaarId . " ";
                        } else {
                            echo "<b>" . $exemplaarId . "</b> ";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php echo $filmSvc->getTotalExemplarenByFilmId($film->getId()) ?>
                </td>
            </tr>
        <?php } ?>

    </table>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>