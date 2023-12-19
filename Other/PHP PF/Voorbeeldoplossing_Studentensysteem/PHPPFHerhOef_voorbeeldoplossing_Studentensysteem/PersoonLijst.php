<?php
//PersoonLijst.php

declare(strict_types=1);
require_once 'Persoon.php';

class PersoonLijst
{
    private string $dbConn;
    private string $dbUsername;
    private string $dbPassword;

    public function __construct()
    {
        $this->dbConn = "mysql:host=localhost;dbname=dbpunten;charset=utf8";
        $this->dbUsername = "root";
        $this->dbPassword = "";
    }

    public function getLijst() : array
    {
        $sql = "select persoonID, naam from personen order by naam";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $persoon = new Persoon((int)$rij["persoonID"], $rij["naam"]);
            array_push($lijst, $persoon);
        }
        $dbh = null;
        return $lijst;
    }

    public function getPersoonById(int $persoonid) : Persoon
    {
        $sql = "select naam from personen where persoonID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $persoonid
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $persoon = new Persoon((int)$persoonid, $rij["naam"]);
        $dbh = null;
        return $persoon;
    }
    
    public function getPersoonByNaam(string $naam) : bool
    {
        $sql = "select naam from personen where naam like :naam";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':naam' => $naam
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $gevonden = !$rij ? false : true;
        $dbh = null;
        return $gevonden;
    }    

    public function updatePersoon(Persoon $persoon)
    {
        $sql = "update personen set naam = :naam where persoonID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':naam' => $persoon->getNaam(),
            ':id' => $persoon->getId()
        ));
        $dbh = null;
    }

    public function createPersoon(string $naam)
    {
        if (!empty($naam)) {
            $sql = "insert into personen (naam) values (:naam)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':naam' => $naam,
            ));
            $dbh = null;
        }
    }

    public function deletePersoon(int $persoonid)
    {
        $sql = "delete from personen where persoonID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $persoonid
        ));
        $dbh = null;
    }

}
