<?php
//broodjesOverzicht.php
declare(strict_types=1);
session_start();
unset($_SESSION["controleKlant"]);

require_once 'BroodjesLijst.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Broodjes</title>
</head>

<body>
    <section>
        <?php
        $broodjesClass = new BroodjesLijst();
        $broodjesLijst = $broodjesClass->getLijst();
        ?>
        <div>
            <h1>Broodjes</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Omschrijving</th>
                        <th scope="col">Prijs</th>
                        <th scope="col">Bestel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($broodjesLijst as $broodje) {
                        ?>
                        <tr>
                            <td>
                                <?php print($broodje->getNaam()); ?>
                            </td>
                            <td>
                                <?php print($broodje->getOmschrijving()); ?>
                            </td>
                            <td>
                                <?php print($broodje->getPrijs()); ?>
                            </td>
                            <td>
                                <a href="gegevensOpvragen.php?besteld=true&broodjeID=<?php print($broodje->getID())?>">Bestel</a></td>

                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table><br>
        </div>
    </section>
    <a href="bestelOverzicht.php">Besteloverzicht</a>
</body>

</html>