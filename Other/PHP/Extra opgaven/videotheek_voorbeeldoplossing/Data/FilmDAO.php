<?php

declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use Data\ExemplaarDAO;
use Entities\Film;
use Exceptions\FilmDoesNotExistException;
use Exceptions\FilmExistsException;

use Exceptions\ExemplaarDoesNotExistException;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/BaseDAO.php";
require_once __DIR__ . "/ExemplaarDAO.php";
require_once __DIR__ . "/../Entities/Film.php";
require_once __DIR__ . "/../Exceptions/FilmDoesNotExistException.php";
require_once __DIR__ . "/../Exceptions/FilmExistsException.php";
*/

class FilmDAO extends BaseDAO
{

    public function getAllFilms(): ?array
    {
        $items = array();

        try {
            $dbh = $this->db_connect();

            $queryStr = "SELECT * FROM films";
            $resultSet = $dbh->query($queryStr);

            foreach ($resultSet as $rij) {
                if ($rij) {
                    $item =  $this->createFilmFromRow($rij);
                    array_push($items, $item);
                }
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return $items;
    }

    public function createFilm($title): ?Film
    {
        try {
            $dbh = $this->db_connect();

            //Check if a film with title already exists.
            $film = null;
            try {
                $film = $this->getFilmByTitle($title);
            } catch (FilmDoesNotExistException $e) {
            }

            if ($film) {
                throw new FilmExistsException("Film with title " . $title . " already exists.");
            }


            $statement = $dbh->prepare("INSERT INTO films (title) VALUES (:title)");
            $statement->bindValue(":title", $title);
            $statement->execute();

            $laatsteNieuweId = $dbh->lastInsertId();

            return new Film((int)$laatsteNieuweId, $title);

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }

    public function getFilmByTitle($title): ?Film
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("SELECT * FROM films WHERE title = :title");
            $statement->bindValue(":title", $title);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                throw new FilmDoesNotExistException("Cannot find film with title: " . $title);
            } else {
                return new Film((int)$row["filmId"], $row["title"]);
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return null;
    }

    public function getFilmById($filmId): ?Film
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("SELECT * FROM films WHERE filmId = :filmId");
            $statement->bindValue(":filmId", $filmId);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                throw new FilmDoesNotExistException("Cannot find film with filmId: " . $filmId);
            } else {
                return new Film((int)$row["filmId"], $row["title"]);
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return null;
    }
	
    public function deleteFilm($filmId)
    {
        $dbh = $this->db_connect();
        try {
            $dbh->beginTransaction();

            $exemplaarDAO = new ExemplaarDAO();
            $exemplaarDAO->deleteAllExemplarenWithFilmId($filmId);


            $statement = $dbh->prepare("DELETE FROM films where filmId = :filmId");
            $statement->bindValue(":filmId", $filmId);
            $statement->execute();

            $dbh->commit();
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            $dbh->rollBack();
        }
        $dbh = null;
    }

    private function createFilmFromRow($row): Film
    {
        return new Film((int)$row["filmId"], $row["title"]);
    }
	
    public function getFilmByExId(int $exemplaarId): ?array
    {
        $items = array();

        try {
            $dbh = $this->db_connect();
			
            $statement = $dbh->prepare("SELECT * FROM films, exemplaren where (films.filmId = exemplaren.filmId) and (exemplaarId = :exemplaarId)");
            $statement->bindValue(":exemplaarId", $exemplaarId);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
           if (!$row) {
                throw new ExemplaarDoesNotExistException("Cannot find exemplaar with exemplaarId: " . $exemplaarId);
            } else {
                    $item =  $this->createFilmFromRow($row);
                    array_push($items, $item);
            }		

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return $items;
    }	
}
