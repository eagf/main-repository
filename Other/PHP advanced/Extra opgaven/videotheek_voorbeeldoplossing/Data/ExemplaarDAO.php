<?php

declare(strict_types=1);

namespace Data;

use Entities\Exemplaar;
use Exceptions\ExemplaarIsUnavailableException;
use Exceptions\ExemplaarDoesNotExistException;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/../Entities/Exemplaar.php";
require_once __DIR__ . "/../Data/BaseDAO.php";
require_once __DIR__ . "/../Exceptions/ExemplaarIsUnavailableException.php";
require_once __DIR__ . "/../Exceptions/ExemplaarDoesNotExistException.php";
*/

class ExemplaarDAO extends BaseDAO
{
    public function createExemplaar(int $filmId): ?Exemplaar
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("INSERT INTO exemplaren (filmId, aanwezig) VALUES (:filmId, :aanwezig)");
            $statement->bindValue(":filmId", $filmId);
            $statement->bindValue(":aanwezig", true);
            $statement->execute();

            $laatsteNieuweId = $dbh->lastInsertId();

            return new Exemplaar((int)$laatsteNieuweId, $filmId, true);

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }

    public function getExemplaarById(int $exemplaarId): ?Exemplaar
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("SELECT * FROM exemplaren WHERE exemplaarId = :exemplaarId");
            $statement->bindValue(":exemplaarId", $exemplaarId);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            if (!$row) {
                throw new ExemplaarDoesNotExistException("Cannot find exemplaar with exemplaarId: " . $exemplaarId);
            } else {
                return new Exemplaar((int)$row["exemplaarId"], (int)$row["filmId"], (bool) $row["aanwezig"]);
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return null;
    }

    public function setExemplaarAvailable(int $exemplaarId, bool $isAvailable)
    {
        try {
            $dbh = $this->db_connect();
            $exemplaar = $this->getExemplaarById($exemplaarId);

            if ($isAvailable == false && !$exemplaar->getAanwezig()) {
                throw new ExemplaarIsUnavailableException("Cannot rent Exemplaar that is already unavailable.");
            }

            $statement = $dbh->prepare("UPDATE exemplaren SET aanwezig = :aanwezig WHERE exemplaarId = :exemplaarId");
            $statement->bindValue(":exemplaarId", $exemplaarId);
            $statement->bindValue(":aanwezig", $isAvailable);
            $statement->execute();

            $laatsteNieuweId = $dbh->lastInsertId();

            return new Exemplaar((int)$laatsteNieuweId, $exemplaar->getFilmId(), $isAvailable);

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }

    public function deleteAllExemplarenWithFilmId($filmId)
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("DELETE FROM exemplaren where filmId = :filmId");
            $statement->bindValue(":filmId", $filmId);
            $statement->execute();

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function deleteExemplaar(int $exemplaarId)
    {
        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("DELETE FROM exemplaren where exemplaarId = :exemplaarId");
            $statement->bindValue(":exemplaarId", $exemplaarId);
            $statement->execute();

            $dbh = null;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getAllExemplaren(): ?array
    {
        $items = array();

        try {
            $dbh = $this->db_connect();

            $queryStr = "SELECT * FROM exemplaren";
            $resultSet = $dbh->query($queryStr);

            foreach ($resultSet as $rij) {
                if ($rij) {
                    $item =  $this->createExemplaarFromRow($rij);
                    array_push($items, $item);
                }
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return $items;
    }

    public function getAllExemplarenByFilmId(int $filmId): ?array
    {
        $items = array();

        try {
            $dbh = $this->db_connect();

            $statement = $dbh->prepare("SELECT * FROM exemplaren WHERE filmId = :filmId");
            $statement->bindValue(":filmId", $filmId);
            $statement->execute();
            $resultSet = $statement->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($resultSet as $rij) {
                if ($rij) {
                    $item =  $this->createExemplaarFromRow($rij);
                    array_push($items, $item);
                }
            }
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

        return $items;
    }

    private function createExemplaarFromRow($row): Exemplaar
    {
        return new Exemplaar(
            (int)$row["exemplaarId"],
            (int)$row["filmId"],
            (bool)$row["aanwezig"]
        );
    }
}
