<?php
// documenten.php

require_once('backend.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
    <title>Documenten</title>
</head>

<body>
    <div class="container">
        <div class="header-container">
            <header>
                <div class="header-img-container">
                    <a href="./index.html"><img class="header-img" src="./img/brain.png" alt="Isabelle Corneillie"></a>
                </div>
                <ul class="header-list">
                    <li class="header-listitem">
                        <a class="header-link" href="./index.html">Home</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./neurologischeStoornissen.html">Neurologische stoornissen</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./praktisch.html">Praktisch</a>
                    </li>
                    <li class="header-listitem active">
                        <a class="header-link" href="./documenten.php">Documenten</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./contact.html">Contact</a>
                    </li>
                </ul>
            </header>
        </div>
        <div id="documenten-container">
            <h1>Documenten</h1>
            <!-- Search Form -->
            <form action="documenten.php" method="post">
                <input type="text" name="search" placeholder="Code ingeven..." required />
                <button type="submit">Zoeken</button>
            </form>

            <?php
            if (isset($searchQuery)) {
                searchAndDisplayFiles($searchQuery);
            } else {
                getMainFiles();
            }
            ?>

        </div>
    </div>
</body>

</html>