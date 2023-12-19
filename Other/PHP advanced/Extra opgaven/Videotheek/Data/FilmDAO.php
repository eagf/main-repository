<?php
//Data/FilmDAO 
declare(strict_types=1);

namespace Data;

use Exceptions\ExemplaarIsAlVerhuurd;
use Exceptions\ExemplaarIsAlTerugGebracht;
use \PDO;
use Exceptions\ExemplaarDoesNotExistException;
use Exceptions\TitelBestaatException;
use Exceptions\NummerBestaatException;
use Data\DBConfig;
use Entities\Film;
use Entities\Exemplaar;

class FilmDAO
{
    public function getExemplarenByFilmId(int $filmId): array
    {
        $sql = "select id, filmId, aanwezig from exemplaren where filmId = :filmId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $filmId));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        if ($resultSet == true) {
            foreach ($resultSet as $rij) {
                $exemplaar = new Exemplaar((int) $rij["id"], (int) $rij["filmId"], (int) $rij["aanwezig"]);
                array_push($lijst, $exemplaar);
            }
        }
        $dbh = null;
        return $lijst;
    }

    public function getTotalExemplarenByFilmId(int $filmId): int
    {
        $sql = "select count(*) from exemplaren where filmId = :filmId and aanwezig = 1";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $filmId));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $aantal = $resultSet["count(*)"];
        return $aantal;
    }

    public function getAanwezigById(int $id): int
    {
        $sql = "select aanwezig from exemplaren where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultSet == true) {
            $aanwezig = $resultSet["aanwezig"];
            return $aanwezig;
        } else {
            return 0;
        }
    }

    public function getAllFilms(): array
    {
        $sql = "select id, titel from films";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $film = new Film((int) $rij["id"], $rij["titel"]);
            array_push($lijst, $film);
        }
        $dbh = null;
        return $lijst;
    }

    public function getAllExemplaren(): array
    {
        $sql = "select id, filmId, aanwezig from exemplaren";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $exemplaar = new Exemplaar((int) $rij["id"], (int) $rij["filmId"], (int) $rij["aanwezig"]);
            array_push($lijst, $exemplaar);
        }
        $dbh = null;
        return $lijst;
    }

    public function getExemplaarById(int $id): ?Exemplaar
    {
        $sql = "select * from exemplaren where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$resultSet) {
           throw new ExemplaarDoesNotExistException();
        } else {
            $exemplaar = new Exemplaar($resultSet["id"], $resultSet["filmId"], $resultSet["aanwezig"]);
            $dbh = null;
            return $exemplaar;
        }
		
    }

    public function createFilm(string $titel)
    {
        $bestaandeFilm = $this->getByTitel($titel);
        if (!is_null($bestaandeFilm)) {
            throw new TitelBestaatException();
        }
        $sql = "insert into films (titel) values (:titel)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $dbh = null;
    }

    public function getByTitel(string $titel): ?Film
    {
        $sql = "select id, titel from films where titel = :titel";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rij) {
            return null;
        } else {
            $film = new Film((int)$rij["id"], $rij["titel"]);
            $dbh = null;
            return $film;
        }
    }
    public function createExemplaar(int $filmId, int $id)
    {
        try {
            $this->getExemplaarById($id);
            throw new NummerBestaatException();
        } catch (ExemplaarDoesNotExistException $ex) {
            $sql = "insert into exemplaren (id, filmId, aanwezig) values (:id, :filmId, 1)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':id' => $id, ':filmId' => $filmId));
            $dbh = null;
        }
    }

    public function deleteFilm(int $id)
    {
        $sql = "delete from exemplaren where filmId = :id; delete from films where id = :id;";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }

    public function deleteExemplaar(int $id)
    {
        $sql = "delete from exemplaren where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }

    public function updateAanwezigheid(int $id, int $aanwezig)
    {
        $exemplaar = $this->getExemplaarById($id);
        if ($exemplaar->getAanwezig() === 0 && $aanwezig === 0) {
            throw new ExemplaarIsAlVerhuurd();
        }
        if ($exemplaar->getAanwezig() === 1 && $aanwezig === 1) {
            throw new ExemplaarIsAlTerugGebracht();
        }
        $sql = "update exemplaren set aanwezig = :aanwezig where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':aanwezig' => $aanwezig, ':id' => $id));
        $dbh = null;
    }
}