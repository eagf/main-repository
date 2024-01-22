<?php
declare(strict_types=1);
?>

<!DOCTYPE HTML>
<!-- Presentation/zoekenOpNummerForm -->
<html>

<head>
    <meta charset=utf-8>
    <title>Zoeken op nummer</title>
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
    <h1>Zoeken op nummer</h1>
    <?php if (isset($exemplaar)) { ?>
            <table>
                <tr>
                    <th style="width:350px">Titel</th>
                    <th>Nummer(s)</th>
                    <th>Exemplaren aanwezig</th>
                </tr>
                <?php foreach ($filmLijst as $film) {
                    if ($film->getId() === $exemplaar->getFilmId()) { ?>
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
                    <?php }
                } ?>
            </table><br>
        <?php } ?>
        <form method="post" action="zoekenOpNummer.php?action=process">
            Nummer:
            <input type="number" name="nummer">
            <input type="submit" value="Zoeken">
        </form>
        <?php if (isset($_GET["error"]) && ($_GET["error"] === "nummerBestaatNiet")) { ?>
            <p style="color:red"> Het gezochte nummer bestaat niet</p>
        <?php } ?>
</body>
<footer>
    <br><a href="index.php">Terug naar hoofdmenu</a>
</footer>

</html>