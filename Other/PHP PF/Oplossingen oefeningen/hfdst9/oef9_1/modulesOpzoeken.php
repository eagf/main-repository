<?php
//modulesOpzoeken.php 
declare(strict_types=1);
require_once("ModuleLijst.php");
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Modules opzoeken</title>
</head>

<body>
    <h1>Zoekresultaat</h1>
    <?php
    $ml = new ModuleLijst();
    $tab = $ml->getLijst((float)$_GET["minimumprijs"],(float)$_GET["maximumprijs"])
    ?>
    <ul>
        <?php
            foreach ($tab as $item) { 
                print("<li>" . $item . "</li>"); 
            }
        ?>
    </ul>
</body>

</html>