<?php
//kleurKiezen.php

declare(strict_types=1);
require_once("Spel.php");

$test = new Veld();
$test->resetVeld();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vier op een rij</title>
</head>

<body>
    <h1>Vier op een Rij</h1>
    <h2>Kies de kleur waar je mee wilt spelen</h2>
    <a href="spelen.php?kleur=1"><img src="oef9_7_img\geel.png" width="80"></a>
    <a href="spelen.php?kleur=2"><img src="oef9_7_img\rood.png" width="80"></a>
</body>

</html>