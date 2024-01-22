<?php
//ModuleLijst.php 
declare(strict_types=1);


class ModuleLijst {
    public function getLijst(float $minimumprijs, float $maximumprijs) : array {
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $sql = "select naam, prijs from modules where (prijs >= ? and prijs <= ?) ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($minimumprijs, $maximumprijs));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst= array();
        foreach ($resultSet as $rij) { 
            $item = $rij["naam"] . " (" . $rij["prijs"] . " euro)"; 
            array_push($lijst, $item);
        }
        $dbh = null; 
        return $lijst;
    }
}
?>

