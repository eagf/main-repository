<?php
if (isset($_POST['submit'])) {
    $targetFolder = 'assets/documenten/' . basename($_POST['folder']);
    $targetFile = $targetFolder . '/' . basename($_FILES['fileToUpload']['name']);

    // File upload logic here
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
        header('Location: admin.php?message=fileAdded');
        exit;    
    } else {
        header('Location: admin.php?error=uploadError');
        exit; 
    }
}
