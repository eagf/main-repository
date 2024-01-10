<?php
declare(strict_types=1);

spl_autoload_register(function ($className) {

    $file = str_replace('\\', '/', $className) . '.php';

    if (file_exists('Business/' . $file)) {
        require ('Business/' . $file);
    }
    if (file_exists('Data/' . $file)) {
        require ('Data/' . $file);
    }
    if (file_exists('Entities/' . $file)) {
        require ('Entities/' . $file);
    }
    if (file_exists('Presentation/' . $file)) {
        require ('Presentation/' . $file);
    }
    if (file_exists('Exceptions/' . $file)) {
        require ('Exceptions/' . $file);
    }
});