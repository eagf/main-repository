<?php
//greeting.php 
declare(strict_types=1);
require_once("GreetingGenerator.php"); 
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Hello world</title>
</head>

<body>
    <h1>
        <?php 
        $gg = new GreetingGenerator();
        print($gg->getGreeting()); 
        ?>
    </h1>
</body>

</html>