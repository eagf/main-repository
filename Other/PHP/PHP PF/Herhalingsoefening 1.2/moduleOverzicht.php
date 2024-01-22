<?php
//moduleOverzicht.php
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
    <title>Puntenoverzicht per module</title>
</head>

<body>
    <h1>Puntenoverzicht per module</h1>
    <?php
    $puntClass = new Puntlijst();
    $moduleClass = new ModuleLijst();
    $moduleLijst = $moduleClass->getLijst();
    foreach ($moduleLijst as $module) {
        $puntLijst = $puntClass->getLijstModule($module->getId());
        print("<h3>" . $module->getNaam() . "</h3>");
        if ($puntLijst) {
            ?>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Punt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($puntLijst as $punt) {
                        ?>
                        <tr>
                            <td>
                                <?php print($punt->getPersoon()->getVoornaam() . " " . $punt->getPersoon()->getFamilienaam()); ?>
                            </td>
                            <td>
                                <?php print($punt->getPunt()); ?>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        <?php } else { ?>
            <h4 style="color: red">Geen punten gevonden voor deze module.</h4>
        <?php }
    } ?><br>
    <a href="persoonOverzicht.php">Overzicht punten per persoon</a><br><br>
    <a href="puntenIngeven.php">Punten ingeven</a>

</body>

</html>