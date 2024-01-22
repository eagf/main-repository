<?php
//Data/GenreDAO
declare(strict_types = 1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Genre;

class GenreDAO {
    
    public function getAll(): Array {
        $sql = "select id, genre from mvc_genres";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING,DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach($resultSet as $rij){
            $genre = Genre::create((int)$rij["id"], $rij["genre"]);
            array_push($lijst, $genre);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) : Genre {
	$sql = "select id, genre from mvc_genres where id = :id" ;
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
	$genre = Genre::create((int)$rij["id"], $rij["genre"]);
	$dbh = null;
	return $genre;
}

}

