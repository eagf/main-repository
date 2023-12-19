<?php
declare(strict_types=1);

namespace Data;

use Data\BaseDAO;

use Entities\Beleg;

class BelegDAO extends BaseDAO
{
    public function getAll(): ?array
    {
        try {
            $dbh = $this->db_connect();
            $resultSet = $dbh->query("select * from beleg");
            $lijst = array();
        foreach ($resultSet as $rij) {
            $beleg = new Beleg((int) $rij["belegid"], $rij["soort"], (float) $rij["prijs"]);
            array_push($lijst, $beleg); 
        }
        $dbh = null;
        return $lijst;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

}
