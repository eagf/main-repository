<?php

declare(strict_types=1);



?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/detail.css">
    <title>Libeer vastgoed</title>
</head>

<body>
    <?php include("includes/header.php"); ?>

    <?php
    require_once 'DBConfig.php';

    function getPandDetails($pandID)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT Panden.*, Adressen.*, PandDetails.*, WettelijkeInformatie.* 
              FROM Panden 
              INNER JOIN Adressen ON Panden.AdresID = Adressen.AdresID
              INNER JOIN PandDetails ON Panden.PandDetailID = PandDetails.PandDetailID
              INNER JOIN WettelijkeInformatie ON Panden.WettelijkeInfoID = WettelijkeInformatie.WettelijkeInfoID
              WHERE Panden.PandID = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $pandID);
            $stmt->execute();

            $pandData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $pandData;
        } catch (PDOException $exception) {
            exit("Error: " . $exception->getMessage());
        }
    }

    function getKamers($pandID)
    {
        $database = new Database();
        $db = $database->getConnection();

        $query = "SELECT * FROM Kamers WHERE PandID = ?";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $pandID);
            $stmt->execute();

            $kamers = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($kamers, $row);
            }
            return $kamers;
        } catch (PDOException $exception) {
            exit("Error: " . $exception->getMessage());
        }
    }

    if ($_GET['pandID']) {
        $pandID = $_GET['pandID'];
        $pandDetails = getPandDetails($pandID);
        $kamers = getKamers($pandID);

        // Hier kun je HTML-code toevoegen om de details van het pand te tonen
        echo "<h1>" . htmlspecialchars($pandDetails['Titel']) . "</h1>";
        // etc. voor andere velden

        echo "<h2>Kamers</h2>";
        foreach ($kamers as $kamer) {
            echo "<p>" . htmlspecialchars($kamer['KamerNaam']) . ": " . htmlspecialchars($kamer['KamerOppervlakte']) . "m² - Detail: " . htmlspecialchars($kamer['KamerDetail']) . "</p>";
        }
    } else {
        echo "Geen pandID opgegeven.";
    }
    ?>


    <?php include 'includes/footer.php'; ?>
</body>

</html>