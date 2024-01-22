<?php
declare(strict_types=1);

namespace Data;

use Data\BaseDAO;

use Entities\Broodje;

class BroodjeDAO extends BaseDAO
{
    public function getAll(): array
    {
        try {
            $dbh = $this->db_connect();
            $resultSet = $dbh->query("select * from broodjes");
            $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new Broodje((int) $rij["broodjeid"], $rij["soort"], (int) $rij["prijs"]);
            array_push($lijst, $broodje); 
        }
        return $lijst;
        $dbh = null;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

}
