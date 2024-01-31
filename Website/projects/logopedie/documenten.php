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
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/documenten.css">
    <script src="scripts.js" defer></script>
    <title>Documenten</title>
</head>

<body>
    <div class="main-container">
        <div class="header-container">
            <header>
                <div class="header-img-container">
                    <a href="./index.html"><img class="header-img" src="./assets/img/brain.png" alt="Isabelle Corneillie"></a>
                </div>
                <ul id="header-list">
                    <li class="header-listitem">
                        <a class="header-link" href="./stoornissen.html">Neurologische stoornissen</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./praktisch.html">Praktisch</a>
                    </li>
                    <li class="header-listitem active">
                        <a class="header-link" href="./documenten.php">Documenten</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./verhaal.html">Mijn verhaal</a>
                    </li>
                    <li class="header-listitem">
                        <a class="header-link" href="./contact.html">Contact</a>
                    </li>
                </ul>

                <div id="hamburger-icon" onclick="toggleNav()">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

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