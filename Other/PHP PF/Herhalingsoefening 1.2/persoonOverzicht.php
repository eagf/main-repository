<?php
//persoonOverzicht.php
declare(strict_types=1);

session_start();

require_once 'ModuleLijst.php';
require_once 'PersoonLijst.php';
require_once 'PuntLijst.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Puntenoverzicht per persoon</title>
</head>

<body>
    <h1>Puntenoverzicht per persoon</h1>
    <?php
    $puntClass = new Puntlijst();
    $persoonClass = new PersoonLijst();
    $persoonLijst = $persoonClass->getLijst();
    foreach ($persoonLijst as $persoon) {
        print("<h3>" . $persoon->getVoornaam() . " " . $persoon->getFamilienaam() . "</h3>");
        $puntLijst = $puntClass->getLijstPersoon($persoon->getId());
        if ($puntLijst) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Module</th>
                        <th scope="col">Punt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($puntLijst as $punt) {
                        ?>
                        <tr>
                            <td>
                                <?php print($punt->getModule()->getNaam()); ?>
                            </td>
                            <td>
                                <?php print($punt->getPunt()); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h4 style="color: red">Geen punten gevonden voor deze persoon.</h4>
        <?php }
    } ?><br>
    <a href="moduleOverzicht.php">Overzicht punten per module</a><br><br>
    <a href="puntenIngeven.php">Punten ingeven</a>
</body>

</html>