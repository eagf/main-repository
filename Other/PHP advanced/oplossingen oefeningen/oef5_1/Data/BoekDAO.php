<?php
//Data/BoekDAO
declare(strict_types = 1);

namespace Data;

use \PDO;
use Exceptions\TitelBestaatException;
use Data\DBConfig;
use Entities\Genre;
use Entities\Boek;


class BoekDAO {
    
    public function getAll(): Array {
        $sql = "select mvc_boeken.id as boek_id, titel,  
			genre_id, genre from mvc_boeken, mvc_genres  
			where genre_id = mvc_genres.id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, 
			DBConfig::$DB_PASSWORD);  
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach($resultSet as $rij){
            $genre = Genre::create((int)$rij["genre_id"], $rij["genre"]);
            $boek = new Boek((int)$rij["boek_id"], $rij["titel"], $genre);
            array_push($lijst, $boek);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getById(int $id) : Boek {
        $sql = "select mvc_boeken.id as boek_id, titel, genre_id, genre from mvc_boeken, mvc_genres where genre_id = mvc_genres.id and mvc_boeken.id = :id" ;
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
       	$stmt->execute(array(':id' => $id));
	$rij = $stmt->fetch(PDO::FETCH_ASSOC);
	$genre = Genre::create((int)$rij["genre_id"], $rij["genre"]);
	$boek = new Boek((int)$rij["boek_id"], $rij["titel"], $genre);
	$dbh = null;
	return $boek;
    }
    public function create(string $titel, int $genreId) {
        
        $bestaandBoek = $this->getByTitel($titel);
        if (!is_null($bestaandBoek)) {
            throw new TitelBestaatException();
        }

	$sql = "insert into mvc_boeken (titel, genre_id) values (:titel, :genreId)";
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel, ':genreId' => $genreId));	
	$boekId = $dbh->lastInsertId();
	$dbh = null;
	$genreDAO = new GenreDAO();
	$genre = $genreDAO->getById($genreId);
        $boek = new Boek((int)$boekId, $titel, $genre);
	return $boek;
    }
    
    public function delete(int $id) {
	$sql = "delete from mvc_boeken where id = :id" ;
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME,DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));	
	$dbh = null;
    } 
    
    public function update(Boek $boek) {
        $bestaandBoek = $this->getByTitel($boek->getTitel());
        if (!is_null($bestaandBoek) && ($bestaandBoek->getId() != $boek->getId() )) {
            throw new TitelBestaatException();
        }

	$sql = "update mvc_boeken set titel = :titel, genre_id = :genreId  where id = :id";
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME,DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $boek->getTitel(), ':genreId' => $boek->getGenre()->getId(), ':id' => $boek->getId()));
	$dbh = null;
    } 
    
    public function getByTitel(string $titel):?Boek {
	$sql = "select mvc_boeken.id as boek_id, titel, genre_id, genre  
		from mvc_boeken, mvc_genres   
		where genre_id = mvc_genres.id and titel = :titel";
	$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
	$stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);	

	if (!$rij) {
		return null;
	} else {
		$genre = Genre::create((int)$rij["genre_id"], $rij["genre"]);
		$boek = new Boek((int)$rij["boek_id"], $rij["titel"], $genre);			
                $dbh = null;
		return $boek;
	}
}


}

