<?php
//data/CursistenDAO.php 

declare(strict_types=1);

require_once("data/DBConfig.php");
require_once("entities/Cursist.php");

class CursistenDAO
{
    // we maken een hard-coded array van cursisten
    // normaal komt hier de code om dit te gaan lezen uit de database 
    // dit doen we in een volgende oefening 

    public function getAll(): array
    {
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select id, familienaam, voornaam from cursisten";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $cursist = new Cursist((int)$rij["id"], $rij["familienaam"], $rij["voornaam"]);
            array_push($lijst, $cursist);
        }
        $dbh = null;
        return $lijst;
    }
}
