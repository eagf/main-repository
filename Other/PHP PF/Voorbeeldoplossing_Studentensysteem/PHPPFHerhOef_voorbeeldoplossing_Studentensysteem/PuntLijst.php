<?php
//PuntLijst.php

declare(strict_types=1);
require_once 'Punt.php';


require_once 'Module.php';
require_once 'Persoon.php';


class PuntLijst
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
    
    public function getPuntById(int $puntid) : Punt
    {
        $sql = "select puntID, modules.moduleID, modules.naam as modulenaam, personen.persoonID, personen.naam as persoonnaam, punt from punten, modules, personen where (punten.moduleID = modules.moduleID) and (punten.persoonID = personen.persoonID) and (puntID = :id)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $puntid
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $module = new Module((int) $rij["moduleID"], $rij["modulenaam"]);
        $persoon = new Persoon((int) $rij["persoonID"], $rij["persoonnaam"]);        
        $punt = new Punt((int) $rij["puntID"], $module, $persoon,(int) $rij["punt"] );        
        
        $dbh = null;
        return $punt;
    }    

    public function getAllePuntenSortModuleLijst() : array
    {
        $sql = "select puntID, modules.moduleID, modules.naam as modulenaam, personen.persoonID, personen.naam as persoonnaam, punt from punten, modules, personen where (punten.moduleID = modules.moduleID) and (punten.persoonID = personen.persoonID) order by modules.naam, punt desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["modulenaam"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["persoonnaam"]);
            $punt = new Punt((int) $rij["puntID"], $module, $persoon,(int) $rij["punt"] );
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function getAllePuntenSortPersoonLijst() : array
    {
        $sql = "select puntID, modules.moduleID, modules.naam as modulenaam, personen.persoonID, personen.naam as persoonnaam, punt from punten, modules, personen where (punten.moduleID = modules.moduleID) and (punten.persoonID = personen.persoonID) order by personen.naam, punt desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["modulenaam"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["persoonnaam"]);
            $punt = new Punt((int) $rij["puntID"], $module, $persoon,(int) $rij["punt"] );
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }    
    
    public function getPuntenPerModuleLijst($moduleid) : array
    {
        $sql = "select puntID, modules.moduleID, modules.naam as modulenaam, personen.persoonID, personen.naam as persoonnaam, punt from punten, modules, personen where (punten.moduleID = modules.moduleID) and (punten.persoonID = personen.persoonID) and (punten.moduleID = :id) order by punt desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $moduleid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["modulenaam"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["persoonnaam"]);
            $punt = new Punt((int) $rij["puntID"], $module, $persoon,(int) $rij["punt"] );
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }    
    
    public function getPuntenPerPersoonLijst($persoonid) : array
    {
        $sql = "select puntID, modules.moduleID, modules.naam as modulenaam, personen.persoonID, personen.naam as persoonnaam, punt from punten, modules, personen where (punten.moduleID = modules.moduleID) and (punten.persoonID = personen.persoonID) and (punten.persoonID = :id) order by punt desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $persoonid
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["modulenaam"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["persoonnaam"]);
            $punt = new Punt((int) $rij["puntID"], $module, $persoon,(int) $rij["punt"] );
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }     
    
    
    public function puntBestaat(int $moduleid, int $persoonid) : bool
    {
        
        $sql = "select punt from punten where moduleID = :moduleid and persoonID = :persoonid";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':moduleid' => $moduleid,
            ':persoonid' => $persoonid,
        ));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        
        //if($stmt->rowCount() == 0) 
        $gevonden = !$resultSet ? false : true;
        $dbh = null;
        return $gevonden;
    }
    
    public function createPunt(int $moduleid, int $persoonid, int $punt)
    {
        if ($punt > -1) {
            $sql = "insert into punten (moduleID, persoonID, punt) values (:moduleid, :persoonid, :punt)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':moduleid' => $moduleid,
                ':persoonid' => $persoonid,
                ':punt' => $punt,
            ));
            $dbh = null;
        }
    }  
    
    public function deletePunt(int $puntid)
    {
        $sql = "delete from punten where puntID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $puntid
        ));
        $dbh = null;
    }    
    
    
    public function updatePunt(int $puntid, int $punt)
    {
        $sql = "update punten set punt = :punt where puntID = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':punt' => $punt,
            ':id' => $puntid
        ));
        $dbh = null;
    }    

}
