<?php
declare(strict_types=1);

namespace Data;

use Data\BaseDAO;
use \PDO;

use Entities\Broodje;

class BroodjeDAO extends BaseDAO
{
    public function getAll(): ?array
    {
        try {
            $dbh = $this->db_connect();
            $resultSet = $dbh->query("select * from broodjes");
            $lijst = array();
            foreach ($resultSet as $rij) {
                $broodje = new Broodje((int) $rij["broodjeid"], $rij["soort"], (float) $rij["prijs"]);
                array_push($lijst, $broodje);
            }
            $dbh = null;
            return $lijst;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    public function getBroodjeByBroodjeId($broodjeid): ?Broodje
    {
        try {
            $dbh = $this->db_connect();
            $sql = "select * from broodjes where broodjeid = :broodjeid";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(":broodjeid", $broodjeid);
            $stmt->execute();
            $rij = $stmt->fetch(PDO::FETCH_ASSOC);
            $beleg = new Broodje((int) $rij["broodjeid"], $rij["soort"], (float) $rij["prijs"]);

            $dbh = null;
            return $beleg;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }

    }
}