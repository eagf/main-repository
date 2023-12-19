<?php
//gegevensOphalenForm.php 
declare(strict_types=1);

?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Gegevens ophalen formulier</title>
</head>

<body>
    <h1>Modules </h1>
    <form action="modulesOpzoeken.php" method="get">
        Geef een minimumprijs: <input type="text" name="minimumprijs"> euro <br><br>
        Geef een maximumprijs: <input type="text" name="maximumprijs"> euro <br>
        <input type="submit" value="OK">
    </form>
</body>

</html>