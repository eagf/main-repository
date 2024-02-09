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
                    echo "<img src='assets/icon/download.png' alt='Download' />";
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
    // Convert search query to lowercase and remove spaces
    $searchQuery = strtolower(trim($searchQuery)); 
    $dirPath = "assets/documenten/" . $searchQuery;

    $dirPath = strtolower($dirPath);

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
                    echo "<img src='assets/icon/download.png' alt='Download' />";
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
    echo "<ul class='directory-list'>";
    foreach ($files as $file) {
        $filePath = realpath($dir . DIRECTORY_SEPARATOR . $file);
        $relativePath = substr($filePath, $rootLength);
        $dataPath = htmlspecialchars(urlencode($relativePath)); // URL encode to ensure it's a safe string
        $isDir = is_dir($filePath);

        if ($isDir) {
            // Display the folder with a clickable area for toggling visibility
            echo "<li data-path='{$dataPath}' class='folder-item'>";
            echo "<div class='folder-name' onclick='toggleFolder(\"" . $dataPath . "\")'><strong><img class='folder-icon' src='assets/icon/folder.svg'> " . htmlspecialchars($file) . "</strong></div>";
            echo " <span class='delete-icon' onclick='confirmDeletion(event, \"" . $dataPath . "\", true)'>&#10006;</span>";
            echo "<div id='folder_" . $dataPath . "' class='folder-contents'>"; // Container for folder contents
            scanDirectory($filePath, $rootLength); // Recursive call
            echo "</div>";
        } else {
            // Display file and its delete icon
            echo "<li data-path='{$dataPath}' class='file-item'>";
            echo htmlspecialchars($file);
            echo " <span class='delete-icon' onclick='confirmDeletion(event, \"" . $dataPath . "\", false)'>&#10006;</span>";
        }
        echo "</li>";
    }
    echo "</ul>";
}

function getFolderOptions($dir) {
    $options = '';
    $folders = array_diff(scandir($dir), array('..', '.'));
    foreach ($folders as $folder) {
        if (is_dir($dir . '/' . $folder)) {
            $options .= '<option value="' . htmlspecialchars($folder) . '">' . htmlspecialchars($folder) . '</option>';
        }
    }
    return $options;
}