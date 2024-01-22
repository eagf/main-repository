<?php
//FilmLijst.php 
declare(strict_types=1);


class FilmLijst {
    public function getLijst() : array {
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $sql = "select titel, duurtijd from films";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array());
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $lijst = array();
        foreach ($resultSet as $rij) { 
            $item = $rij["titel"] . " (" . $rij["duurtijd"] . " min)"; 
            array_push($lijst, $item);
        }
        $dbh = null; 
        return $lijst;
    }
    public function addFilm(string $titel, int $duurtijd) {
        $sql = "insert into films (titel, duurtijd) values (:titel, :duurtijd)"; 
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd"); 
        $stmt= $dbh->prepare($sql); 
        $stmt->execute(array(':titel' => $titel, ':duurtijd' => $duurtijd)); 
        $dbh = null;
    }
}
?>

