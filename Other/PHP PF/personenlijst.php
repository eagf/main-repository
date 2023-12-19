<?php
//personenlijst.php 
declare(strict_types=1);
class PersonenLijst
{
    public function getLijst()
    {
        $lijst = array();
        $dbh = new PDO("mysql:host=localhost;port=3306;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $dbh = null;
    }
} ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Databanken introductie</title>
</head>

<body>
    <?php $pl = new PersonenLijst();
    $pl->getLijst(); ?>
</body>

</html>