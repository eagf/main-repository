<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/admin.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="./scripts/images.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" defer></script>
    <title>Select Pand to Delete</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="back-to-admin">
            <a href="admin.php" class="back-button">Back to Admin Page</a>
        </div>

        <div class="form-container">

            <?php if (isset($message)) {
                echo "<p class='success'>" . $message . "</p>";
            } ?>

            <h2>Afbeeldingen</h2>

            <form action="images.php" method="GET">
                <h3>Selecteren</h3>
                <label for="pandID">Selecteer een pand:</label>
                <select id="pandID" name="pandID">
                    <?php getPandenSelect(); ?>
                </select>
                <br>
                <button type="submit">Ga naar afbeeldingen</button>
            </form>

            <?php if ($pandID) {
                getPandDetailsByPandID($pandID);
                $images = getImagesByPandID($pandID);
            ?>

                <!-- Form for uploading images -->

                <form action="./data/imageBackend.php" method="POST" enctype="multipart/form-data">
                    <h3>Uploaden</h3>
                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">
                    <div id="fileUploadContainer">
                        <div class="file-upload-block">
                            <label for="imageUploadX">Upload afbeelding:</label>
                            <input type="file" class="image-input" id="imageUploadX" name="image[]" accept="image/*">
                            <div class="image-preview" id="imagePreviewX"></div>
                            <label for="descriptionX">Beschrijving:</label>
                            <textarea id="descriptionX" name="description[]"></textarea>
                        </div>
                    </div>
                    <button type="button" id="addMoreImages">+</button>
                    <button type="submit" name="upload">Upload alle afbeeldingen</button>
                </form>


                <!-- Form for changing image order -->
                <form action="./data/imageBackend.php" method="POST">
                    <h3>Wijzig volgorde</h3>
                    <input type="hidden" name="action" value="update_order">
                    <input type="hidden" name="pandID" value="<?php echo htmlspecialchars($pandID); ?>">
                    <div class="image-order-container" id="sortable">
                        <?php foreach ($images as $key => $image) : ?>
                            <div class="image-order-block" data-id="<?php echo htmlspecialchars($image['afbeeldingID']); ?>">
                                <div class="image-preview">
                                    <img src="<?php echo htmlspecialchars($image['afbeeldingURL']); ?>" alt="<?php echo htmlspecialchars($image['beschrijving']); ?>">
                                </div>
                                <div class="image-order">
                                    <label for="order<?php echo $key; ?>">Volgorde:</label>
                                    <span class="order-number"><?php echo htmlspecialchars($image['volgorde']); ?></span>
                                    <input type="hidden" name="order[<?php echo htmlspecialchars($image['afbeeldingID']); ?>]" value="<?php echo htmlspecialchars($image['volgorde']); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit">Wijzig volgorde</button>
                </form>

                <!-- Form for deleting images -->

                <form action="./data/imageBackend.php" method="POST">
                    <h3>Verwijderen</h3>
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

                <!-- Form for changing description images -->

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
                                    <textarea name="descriptions[<?php echo htmlspecialchars($image['afbeeldingID']); ?>]" rows="4"><?php echo htmlspecialchars($image['beschrijving']); ?></textarea>
                                </div>
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