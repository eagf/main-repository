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
