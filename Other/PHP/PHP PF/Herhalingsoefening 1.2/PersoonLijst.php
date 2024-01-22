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
        $this->dbConn = "mysql:host=localhost;dbname=cursusphp;charset=utf8";
        $this->dbUsername = "root";
        $this->dbPassword = "";
    }

    public function getLijst(): array
    {
        $sql = "select id, familienaam, voornaam, geboortedatum, geslacht from personen";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $persoon = new Persoon((int) $rij["id"], $rij["familienaam"], $rij["voornaam"], $rij["geboortedatum"], $rij["geslacht"]);
            array_push($lijst, $persoon);
        }
        $dbh = null;
        return $lijst;
    }

    /*
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
       */

}