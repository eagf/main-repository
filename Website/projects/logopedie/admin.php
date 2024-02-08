<?php
// admin.php

require_once('backend.php');

// Start from the root 'documenten' directory
$rootDir = "assets/documenten";
$rootLength = strlen(getcwd()) + 1; // To calculate the relative path

// Add message for admin

$error = "";

if (isset($_GET["error"])) {
    if ($_GET["error"] == "exists") {
        $message = "De map bestaat al.";
    }
    if ($_GET["error"] == "uploadError") {
        $message = "Er is een fout opgetreden bij het uploaden van het bestand.";
    }
}

$message = "";

if (isset($_GET["message"])) {
    if ($_GET["message"] == "removed") {
        $message = "Bestand(en) succesvol verwijderd.";
    } elseif ($_GET["message"] == "folderAdded") {
        $message = "Map succesvol toegevoegd.";
    } elseif ($_GET["message"] == "fileAdded") {
        $message = "Bestand succesvol toegevoegd.";
    }
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

    <script defer>
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


        function toggleFolder(dataPath) {
            var folderContents = document.getElementById('folder_' + dataPath);
            if (folderContents.style.display === 'none') {
                folderContents.style.display = 'block';
            } else {
                folderContents.style.display = 'none';
            }
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
            <h1>Admin</h1>

            <p id="message">
                <?php if (isset($message)) {
                    echo $message;
                } ?>
            </p>

            <p id="error">
                <?php if (isset($error)) {
                    echo $error;
                } ?>
            </p>

            <h2>Documenten structuur</h2>
            <?php scanDirectory($rootDir, $rootLength); ?>

            <h2>Documenten uploaden</h2>
            <!-- File Upload Form -->
            <form action="upload.php" method="post" enctype="multipart/form-data" id="file-upload-form" class="admin-form">
                <div class="form-group">
                    <label for="folderSelect">Kies een map:</label>
                    <select name="folder" id="folderSelect" class="form-control">
                        <?php echo getFolderOptions('assets/documenten'); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileToUpload">Bestand uploaden:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                </div>
                <input type="submit" value="Upload Bestand" name="submit" class="btn btn-primary">
            </form>

            <!-- New Folder Creation Form -->
            <form action="createFolder.php" method="post" id="folder-creation-form" class="admin-form">
                <div class="form-group">
                    <label for="newFolderName">Nieuwe mapnaam:</label>
                    <input type="text" name="newFolderName" id="newFolderName" class="form-control">
                </div>
                <input type="submit" value="Maak nieuwe map" name="createFolder" class="btn btn-success">
            </form>

        </div>

    </div>

</body>

</html>