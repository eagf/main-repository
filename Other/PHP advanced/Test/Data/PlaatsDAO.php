<?php

declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use \PDO;

use Exceptions\NietInDatabaseException;

use Entities\Plaats;

class PlaatsDAO extends BaseDAO
{
    public function getAll(): ?array
    {
        try {
            $dbh = $this->db_connect();
            $resultSet = $dbh->query("select * from plaatsen");
            $lijst = array();
            foreach ($resultSet as $rij) {
                $plaats = new Plaats(
                    (int) $rij["plaatsId"],
                    $rij["postcode"],
                    $rij["woonplaats"],
                    (int) $rij["isLeverbaar"]
                );
                array_push($lijst, $plaats);
            }
            $dbh = null;
            return $lijst;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function getPlaatsByKlantId($klantId): ?Plaats
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select 
            plaatsen.plaatsId as plaatsId, 
            plaatsen.postcode as postcode, 
            plaatsen.woonplaats as woonplaats, 
            plaatsen.isLeverbaar as isLeverbaar 
            from plaatsen 
            inner join klanten 
            on plaatsen.plaatsId = klanten.plaatsId 
            where klanten.klantId = :klantId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":klantId", $klantId);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$rij) {
                throw new NietInDatabaseException();
            }
            $plaats = new Plaats(
                (int) $rij["plaatsId"],
                $rij["postcode"],
                $rij["woonplaats"],
                (int) $rij["isLeverbaar"]
            );
            $dbh = null;
            return $plaats;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
    public function getPlaatsByPostcode($postcode): ?Plaats
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select * from plaatsen where postcode = :postcode";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":postcode", $postcode);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$rij) {
                throw new NietInDatabaseException();
            }
            $plaats = new Plaats(
                (int) $rij["plaatsId"],
                $rij["postcode"],
                $rij["woonplaats"],
                (int) $rij["isLeverbaar"]
            );
            $dbh = null;
            return $plaats;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }
}
