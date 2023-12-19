<?php
//ModuleLijst.php

declare(strict_types=1);
require_once 'Module.php';

class ModuleLijst
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
        $sql = "select moduleID, naam from modules order by naam";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int)$rij["moduleID"], $rij["naam"]);
            array_push($lijst, $module);
        }
        $dbh = null;
        return $lijst;
    }

    public function getModuleById(int $moduleid) : Module
    {
        $sql = "select naam from modules where moduleID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $moduleid
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $module = new Module((int)$moduleid, $rij["naam"]);
        $dbh = null;
        return $module;
    }
    
    public function getModuleByNaam(string $naam) : bool
    {
        $sql = "select naam from modules where naam like :naam";
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

    public function updateModule(Module $module)
    {
        $sql = "update modules set naam = :naam where moduleID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':naam' => $module->getNaam(),
            ':id' => $module->getId()
        ));
        $dbh = null;
    }

    public function createModule(string $naam)
    {
        if (!empty($naam)) {
            $sql = "insert into modules (naam) values (:naam)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':naam' => $naam,
            ));
            $dbh = null;
        }
    }

    public function deleteModule(int $moduleid)
    {
        $sql = "delete from modules where moduleID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $moduleid
        ));
        $dbh = null;
    }

}
