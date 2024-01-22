<?php
//ModuleLijst.php

declare(strict_types=1);

class ModuleLijst
{

    public function getLijst() : array
    {
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");

        $sql = "select naam, prijs from modules where prijs >= :minprijs and prijs <= :maxprijs order by prijs";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':minprijs' => $_GET["minprijs"], ':maxprijs' => $_GET["maxprijs"]));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = $rij["naam"] . " (" . $rij["prijs"] . " euro)";
            array_push($lijst, $module);
        }
        $dbh = null;
        return $lijst;
    }

}
    