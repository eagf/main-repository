<?php

declare(strict_types=1);

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Broodjeslijst</title>

<body>

    <h1>Broodjeslijst</h1>
    <p>Maak hieronder een selectie van jouw gewenste broodje:</p>
    <form action="broodjeslijst.php?action=process" method="post">
        <label for="email">Type broodje: </label>
        <select name="selBroodje">
            <?php
            foreach ($broodjeslijst as $broodje) {
                ?>
                <option value="<?php echo $broodje->getBroodjeid(); ?>"> <?php echo $broodje->getSoort(); ?> </option>
                <?php
            }
            ?>
        </select><br><br>

        <label for="beleg">Soort(en) beleg: </label><br>
        <?php
        foreach ($beleglijst as $beleg) {
            $belegid = $beleg->getBelegid();
            $belegSoort = $beleg->getSoort();
            ?>
            <input type="checkbox" name="<?php echo $belegid ?>" value="<?php echo $belegid ?>">
            <label for="<?php echo $belegid ?>"><?php echo $belegSoort ?></label><br>
            <?php
        }
        ?>
        <br><button type="submit">Broodje bestellen</button>
    </form>
    <?php
    if ($error) {
        ?>
        <p style="color:red">
            <?php echo $error; ?>
        </p>
        <?php
    }
    if (isset($_GET["action"]) && ($_GET["action"]) === "besteld") {
        ?>
        <p style="color:green">Het broodje is besteld!</p>
    <?php } ?>
    <br>
    <a href="bestellinglijst.php?action=">bestelling(en)</a><br><br><br>
    <a href="broodjeslijst.php?action=valsetijd">"Voor 10:00"</a><br>
    <a href="broodjeslijst.php?action=echtetijd">Echte tijd</a><br><br><br>
    <a href="inloggen.php?action=uitloggen">uitloggen</a><br>

</body>

</html>