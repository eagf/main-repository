<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="./scripts/images.js" defer></script>
    <title>Select Pand to Delete</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="form-container">

            <?php if (isset($message)) {
                echo "<p class='success'>" . $message . "</p>";
            } ?>

            <h2>Afbeeldingen</h2>
            <?php
            if ($pandID) {
                getPandDetailsByPandID($pandID);
            }
            ?>

            <form action="images.php" method="GET">
                <h3>Selecteren</h3>
                <label for="pandID">Selecteer een pand:</label>
                <select id="pandID" name="pandID">
                    <?php getPandenSelect(); ?>
                </select>
                <br>
                <button type="submit">Ga naar afbeeldingen</button>
            </form>

            <?php if ($pandID) { ?>
                <form action="./data/imageBackend.php" method="POST" enctype="multipart/form-data">
                    <h3>Uploaden</h3>

                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">
                    <div id="fileUploadContainer">
                        <div class="file-upload-block">
                            <label for="imageUpload1">Upload afbeelding:</label>
                            <input type="file" id="imageUpload1" name="image[]" accept="image/*">
                            <label for="description1">Beschrijving:</label>
                            <textarea id="description1" name="description[]"></textarea>
                        </div>
                    </div>

                    <button type="button" id="addMoreImages">Voeg meer afbeeldingen toe</button>

                    <button type="submit" name="upload">Voeg afbeeldingen toe</button>
                </form>

                <form action="./data/imageBackend.php" method="POST">
                    <h3>Verwijderen</h3>
                    <!-- CONTROL STILL IN CODE!!!!!!!!!!!!!!!! -->
                    <h3 style="color: red">De eerste 6 van de voorbeelden zijn nog niet te verwijderen</h3>
                    <!-- CONTROL STILL IN CODE!!!!!!!!!!!!!!!! -->
                    <input type="hidden" name="action" value="delete_images">
                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">

                    <div class="image-checkboxes">
                        <?php
                        $images = getImagesByPandID($pandID);
                        foreach ($images as $key => $image) : ?>
                            <div class="image-checkbox-block">
                                <input type="checkbox" id="imageCheckbox<?php echo $key; ?>" name="imagesToDelete[]" value="<?php echo htmlspecialchars($image['afbeeldingURL']); ?>" class="image-checkbox">
                                <label for="imageCheckbox<?php echo $key; ?>" class="image-label">
                                    <img src="<?php echo htmlspecialchars($image['afbeeldingURL']); ?>" alt="<?php echo htmlspecialchars($image['beschrijving']); ?>">
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit">Verwijder afbeeldingen</button>
                </form>

                <form action="./data/imageBackend.php" method="POST">
                    <h3>Bewerk beschrijvingen</h3>
                    <input type="hidden" name="action" value="update_descriptions">
                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">

                    <div class="image-update-container">
                        <?php
                        foreach ($images as $key => $image) : ?>
                            <div class="image-update-block">
                                <div class="image-preview">
                                    <img src="<?php echo htmlspecialchars($image['afbeeldingURL']); ?>" alt="<?php echo htmlspecialchars($image['beschrijving']); ?>">
                                </div>
                                <div class="image-description">
                                <textarea name="descriptions[<?php echo htmlspecialchars($image['afbeeldingID']); ?>]" rows="4"><?php echo htmlspecialchars($image['beschrijving']); ?></textarea>                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit">Wijzigingen opslaan</button>
                </form>

            <?php } ?>

        </div>

    </div>

    <?php include("includes/footer.php"); ?>

</body>