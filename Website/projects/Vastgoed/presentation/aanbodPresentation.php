<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/aanbod.css">
    <link rel="stylesheet" type="text/css" href="./styles/header.css">
    <link rel="icon" href="./assets/img/logo.ico">
    <script src="scripts/aanbod.js" defer></script>
    <title>Libeer vastgoed</title>
</head>

<body>
    <div id="wrapper">

        <?php include("includes/header.php"); ?>

        <div class="filter-container">
            <p id="te-koop-selector" class="slider-text <?php echo $statusFilter === 'Te koop' ? 'active' : ''; ?>">Te koop</p>
            <label class="switch">
                <input type="checkbox" id="statusToggle" onchange="submitForm()" <?php echo $statusFilter === 'Te koop' ? '' : 'checked'; ?>>
                <span class="slider"></span>
            </label>
            <p id="te-huur-selector" class="slider-text <?php echo $statusFilter === 'Te huur' ? 'active' : ''; ?>">Te huur</p>
        </div>
        <div class="grid-container">
            <?php foreach ($pandenOverzicht as $pand) : ?>
                <a href="<?php echo $pand['isVerkochtVerhuurd'] == 1 ? '#' : 'detail.php?pandID=' . htmlspecialchars((string)$pand['pandID']); ?>" class="card-link <?php echo $pand['isVerkochtVerhuurd'] == 1 ? 'disabled-link' : ''; ?>">
                    <div class="card">
                        <?php if ($pand['isVerkochtVerhuurd'] == 1) : ?>
                            <?php
                            $verkochtVerhuurdText = ($pand['status'] == "Te koop") ? "Verkocht" : "Verhuurd";
                            ?>
                            <div class="ribbon ribbon-sold ribbon-top-right"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $verkochtVerhuurdText; ?></span></div>
                        <?php elseif ($pand['isNieuw'] == 1) : ?>
                            <div class="ribbon ribbon-new ribbon-top-right"><span>&nbsp;&nbsp;Nieuw</span></div>
                        <?php endif; ?>
                        <div class="card-carousel">
                            <div class="card-image-container">
                                <?php
                                if (!is_null($pand['afbeeldingen'])) {
                                    $afbeeldingen = explode(',', $pand['afbeeldingen']);
                                    foreach ($afbeeldingen as $afbeelding) {
                                        echo '<div class="card-image" style="background-image: url(' . htmlspecialchars($afbeelding) . ');"></div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-info">
                            <h2 class="card-title"><?php echo htmlspecialchars($pand['titel']); ?></h2>
                            <p class="card-gemeente"><?php echo htmlspecialchars($pand['gemeente']); ?></p>
                            <?php if ($pand['isVerkochtVerhuurd'] == 0 || is_null($pand['isVerkochtVerhuurd'])) : ?>
                                <p class="card-prijs">
                                    € <?php echo htmlspecialchars(number_format((int)$pand['prijs'], 0, ',', '.')); ?>
                                    <?php if ($statusFilter === 'Te huur') : ?> / maand<?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>







    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>