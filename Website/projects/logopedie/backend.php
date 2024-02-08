<?php
// backend.php

function getMainFiles()
{
    $dirPath = "assets/documenten/algemeneDocumenten";

    if (is_dir($dirPath)) {
        if ($dh = opendir($dirPath)) {
            echo "<h2 class='documenten-title'>Algemene documenten</h2>";
            echo "<div id='documenten-grid-container'>";
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $filePath = $dirPath . '/' . $file;
                    echo "<a href='" . htmlspecialchars($filePath) . "' download class='document-card'>";
                    echo "<div>";
                    echo "<h3>" . htmlspecialchars($file) . "</h3>";
                    echo "</div>";
                    echo "<div class='download-icon-container'>";
                    echo "<img src='assets/img/download.png' alt='Download' />";
                    echo "</div>";
                    echo "</a>";
                }
            }
            echo "</div>";
            closedir($dh);
        }
    }
}

function searchAndDisplayFiles($searchQuery)
{
    $dirPath = "assets/documenten/" . $searchQuery;

    if (is_dir($dirPath)) {
        if ($dh = opendir($dirPath)) {
            echo "<h2 class='documenten-title'>Persoonlijke documenten</h2>";
            echo "<div id='documenten-grid-container'>";
            while (($file = readdir($dh)) !== false) {
                if ($file != "." && $file != "..") {
                    $filePath = $dirPath . '/' . $file;

                    echo "<a href='" . htmlspecialchars($filePath) . "' download class='document-card'>";
                    echo "<div>";
                    echo "<h3>" . htmlspecialchars($file) . "</h3>";
                    echo "</div>";
                    echo "<div class='download-icon-container'>";
                    echo "<img src='assets/img/download.png' alt='Download' />";
                    echo "</div>";
                    echo "</a>";
                }
            }
            echo "</div>";
            closedir($dh);
        }
    } else {
        echo "<p id='error'>De code bestaat niet of de code is verkeerd ingegeven. Probeer opnieuw.</p>";
        getMainFiles();
    }
}

// Function to scan the directory recursively
function scanDirectory($dir, $rootLength)
{
    $files = array_diff(scandir($dir), array('..', '.'));
    echo "<ul>";
    foreach ($files as $file) {
        $filePath = realpath($dir . DIRECTORY_SEPARATOR . $file);
        $relativePath = substr($filePath, $rootLength);
        $dataPath = htmlspecialchars(urlencode($relativePath)); // URL encode to ensure it's a safe string
        $deleteLink = "delete.php?path=" . $dataPath;

        echo "<li data-path='{$dataPath}'>";
        if (is_dir($filePath)) {
            echo "<strong>[Folder]</strong> ";
        }
        echo htmlspecialchars($relativePath);
        echo " <span class='delete-icon' onclick='confirmDeletion(event, \"" . $dataPath . "\", " . (is_dir($filePath) ? "true" : "false") . ")'>&#10006;</span>";
        if (is_dir($filePath)) {
            scanDirectory($filePath, $rootLength); // Recursive call
        }
        echo "</li>";
    }
    echo "</ul>";
}
