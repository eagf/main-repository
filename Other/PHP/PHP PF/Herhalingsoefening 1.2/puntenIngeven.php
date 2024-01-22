<?php
//puntenIngeven.php
declare(strict_types=1);

session_start();

require_once 'ModuleLijst.php';
require_once 'PersoonLijst.php';
require_once 'PuntLijst.php';



if (isset($_GET["ingeven"]) && $_GET["ingeven"] == 1) {
    $moduleID = (int) $_POST["module"];
    $persoonID = (int) $_POST["persoon"];
    $punt = (int) $_POST["punt"];

    $puntClass = new Puntlijst();
    if (!$puntClass->getLijstModuleEnPersoon($moduleID, $persoonID)) {
        $puntClass->createPunt($moduleID, $persoonID, $punt);
    } else {
        $_SESSION["dubbelePunten"] = true;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Punten ingeven</title>
</head>

<body>
    <h1>Punten ingeven</h1>

    <?php
    $moduleClass = new ModuleLijst();
    $moduleLijst = $moduleClass->getLijst();
    $persoonClass = new PersoonLijst();
    $persoonLijst = $persoonClass->getLijst();
    ?>

    <form action="puntenIngeven.php?ingeven=1" method='post'>

        <label for="module">Module:</label>
        <select id="module" name="module">
            <?php
            foreach ($moduleLijst as $module) {
                ?>
                <option value="<?php print($module->getId()) ?>"><?php print($module->getNaam()) ?></option>
            <?php }
            ?>
        </select><br><br>
        <label for="persoon">Naam student:</label>
        <select id="persoon" name="persoon">
            <?php
            foreach ($persoonLijst as $persoon) {
                ?>
                <option value="<?php print($persoon->getId()) ?>"><?php print($persoon->getVoornaam() . " " . $persoon->getFamilienaam()) ?></option>
            <?php }
            ?>
        </select><br><br>
        <label for="punt">Punt:</label>
        <input type="number" id="punt" name="punt" min="0" max="100"><br><br>
        <input type="submit" value="Toevoegen">
    </form><br>

    <?php
    if (isset($_SESSION["dubbelePunten"]) && $_SESSION["dubbelePunten"] == true) {
        ?>
        <p style="color : red">Deze student heeft al een punt voor de gekozen module.</p>
        <?php
        unset($_SESSION["dubbelePunten"]);
    }
    ?>
    <a href="moduleOverzicht.php">Overzicht punten per module</a><br>
    <a href="persoonOverzicht.php">Overzicht punten per persoon</a>
</body>

</html>