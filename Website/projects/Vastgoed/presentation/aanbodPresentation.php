<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/aanbod.css">
    <title>Libeer vastgoed</title>
</head>

<body>
    <?php include("includes/header.php"); ?>
    <div class="filter-container">
        <form action="" method="GET">
            <input type="radio" id="all" name="status" value="all" <?php echo $statusFilter === 'all' ? 'checked' : ''; ?>>
            <label for="all">Alles</label>
            <input type="radio" id="teKoop" name="status" value="Te koop" <?php echo $statusFilter === 'Te koop' ? 'checked' : ''; ?>>
            <label for="teKoop">Te koop</label>
            <input type="radio" id="teHuur" name="status" value="Te huur" <?php echo $statusFilter === 'Te huur' ? 'checked' : ''; ?>>
            <label for="teHuur">Te huur</label>
            <input type="submit" value="Filter">
        </form>
    </div>
    <div class="grid-container">
        <?php foreach ($pandenOverzicht as $pand): ?>
            <div class="card">
                <div class="card-image" style="background-image: url('<?php echo htmlspecialchars($pand['afbeeldingen']); ?>');"></div>
                <div class="card-info">
                    <h2 class="card-title"><?php echo htmlspecialchars($pand['titel']); ?></h2>
                    <p class="card-gemeente"><?php echo htmlspecialchars($pand['gemeente']); ?></p>
                    <p class="card-prijs">€ <?php echo htmlspecialchars(number_format((float)$pand['prijs'], 2, ',', '.')); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>