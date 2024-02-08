<?php
if (isset($_POST['createFolder'])) {
    $newFolderName = preg_replace('/[^A-Za-z0-9_\-]/', '', $_POST['newFolderName']); // Sanitize folder name
    $newFolderPath = 'assets/documenten/' . $newFolderName;

    if (!file_exists($newFolderPath)) {
        mkdir($newFolderPath, 0777, true);
        header('Location: admin.php?message=folderAdded');
        exit;
    } else {
        header('Location: admin.php?error=exists');
        exit;
    }
}
