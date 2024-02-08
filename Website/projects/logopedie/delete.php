<?php
// delete.php

// Implement authentication and security checks here.

if (isset($_GET['path'])) {
    $path = urldecode($_GET['path']); // Decode URL-encoded string
    $fullPath = realpath($path);

    // Security checks to ensure the $fullPath is within the allowed directory
    $baseDir = realpath('assets/documenten') . DIRECTORY_SEPARATOR;
    
    if (strpos($fullPath, $baseDir) === 0) {
        if (is_dir($fullPath)) {
            // It's a directory; use recursive deletion
            $iterator = new RecursiveDirectoryIterator($fullPath, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            rmdir($fullPath); // Delete directory after emptying it
        } else {
            // It's a file; delete it directly
            unlink($fullPath);
        }
        
        // Redirect or inform of success
        
        echo "Het bestand of de map is succesvol verwijderd.";
        // After deletion,redirect back to the admin page
header('Location: admin.php?message=removed');
exit;
    } else {
        // Attempted to access a file outside the allowed directory
        exit('Ongeautoriseerde actie.');
    }
} else {
    exit('Geen bestand of map gespecificeerd.');
}

