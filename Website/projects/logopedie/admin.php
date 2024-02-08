<?php
// admin.php

require_once('backend.php');

// Start from the root 'documenten' directory
$rootDir = "assets/documenten";
$rootLength = strlen(getcwd()) + 1; // To calculate the relative path

// Add message for admin
$message = "";

if (isset($_GET["message"]) && $_GET["message"] == "removed") {
    $message = "Bestand(en) succesvol verwijderd.";
};

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/admin.css">
    <title>Admin Isabelle</title>

    <script>
        function confirmDeletion(event, dataPath, isDir) {
            event.preventDefault(); // Prevent default action

            var message = isDir ? 'Weet u zeker dat u de gehele map wilt verwijderen? Dit kan niet ongedaan gemaakt worden.' : 'Weet u zeker dat u dit bestand wilt verwijderen? Dit kan niet ongedaan gemaakt worden.';
            if (!confirm(message)) {
                return; // User cancelled the action
            }

            // AJAX call to the server to delete the file/folder
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'delete.php?path=' + dataPath, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Find the item with the matching data-path attribute and remove it
                    document.querySelector(`li[data-path='${dataPath}']`).remove();
                } else {
                    alert('Er was een probleem met het verwijderverzoek.');
                }
            };
            xhr.onerror = function() {
                alert('Er was een probleem met het verwijderverzoek.');
            };
            xhr.send();
        }
    </script>


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
                    <li class="header-listitem">
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

        <div id="admin-container">
            <p id="message">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </p>
            <h1>Admin</h1>
            <h2>Documenten structuur</h2>
            <?php scanDirectory($rootDir, $rootLength); ?>
        </div>

    </div>

</body>

</html>