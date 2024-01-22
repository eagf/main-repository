<?php
//FilmLijst.php 
declare(strict_types=1);


class FilmLijst {
    public function getLijst() : array {
        $sql = "select id, titel, duurtijd from films";
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $resultSet = $dbh->query($sql); 
        $lijst = array();
        foreach ($resultSet as $rij) { 
            $film = new Film((int) $rij["id"], $rij["titel"], (float) $rij["duurtijd"]); 
            array_push($lijst, $film); 
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
    public function removeFilm(int $id) {
        $sql = "delete from films where id = :id";
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}

class Film {
    private int $id;
    private string $titel;
    private float $duurtijd;
    public function __construct(int $id, string $titel, float $duurtijd) { 
        $this->id = $id; 
        $this->titel = $titel; 
        $this->duurtijd = $duurtijd; }
    public function getId() : int {
        return $this->id;
    }
    public function getTitel() : string {
        return $this->titel;
    }
    public function getDuurtijd() : float {
        return $this->duurtijd;
    }
}
?>

