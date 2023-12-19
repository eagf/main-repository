<?php
//Puntlijst.php

declare(strict_types=1);
require_once 'Module.php';
require_once 'Persoon.php';
require_once 'Punt.php';

class Puntlijst
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
        $sql = "select modules.id as moduleID, naam, prijs, personen.id as persoonID, familienaam, voornaam, geboortedatum, geslacht, punt 
        from modules, personen, punten where moduleID = modules.id and persoonID = personen.id";
        // $sql = "select bestellingen.id, datumtijd, gebruikers.id, 
        // gebruikers.naam as gebruikernaam, email, wachtwoord, geblokkeerd, 
        // broodjes.id, broodjes.naam as broodjesnaam, omschrijving, prijs 
        // from bestellingen, broodjes, gebruikers 
        // where broodid = broodjes.id and gebrid = gebruikers.id 
        // order by datumtijd desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["naam"], (int) $rij["prijs"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["familienaam"], $rij["voornaam"], $rij["geboortedatum"], $rij["geslacht"]);
            $punt = new Punt($module, $persoon, (int) $rij["punt"]);
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }

    public function getLijstModule(int $moduleID): array
    {
        $sql = "select modules.id as moduleID, naam, prijs, personen.id as persoonID, familienaam, voornaam, geboortedatum, geslacht, punt 
        from modules, personen, punten where moduleID = modules.id and persoonID = personen.id and moduleID = :moduleID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':moduleID' => $moduleID
            )
        );
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["naam"], (int) $rij["prijs"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["familienaam"], $rij["voornaam"], $rij["geboortedatum"], $rij["geslacht"]);
            $punt = new Punt($module, $persoon, (int) $rij["punt"]);
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }

    public function getLijstPersoon(int $persoonID): array
    {
        $sql = "select modules.id as moduleID, naam, prijs, personen.id as persoonID, familienaam, voornaam, geboortedatum, geslacht, punt 
        from modules, personen, punten where moduleID = modules.id and persoonID = personen.id and persoonID = :persoonID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':persoonID' => $persoonID
            )
        );
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["naam"], (int) $rij["prijs"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["familienaam"], $rij["voornaam"], $rij["geboortedatum"], $rij["geslacht"]);
            $punt = new Punt($module, $persoon, (int) $rij["punt"]);
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }

    public function getLijstModuleEnPersoon(int $moduleID, int $persoonID): array
    {
        $sql = "select modules.id as moduleID, naam, prijs, personen.id as persoonID, familienaam, voornaam, geboortedatum, geslacht, punt 
        from modules, personen, punten where moduleID = modules.id and persoonID = personen.id and moduleID = :moduleID and persoonID = :persoonID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':moduleID' => $moduleID,
                ':persoonID' => $persoonID
            )
        );
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $module = new Module((int) $rij["moduleID"], $rij["naam"], (int) $rij["prijs"]);
            $persoon = new Persoon((int) $rij["persoonID"], $rij["familienaam"], $rij["voornaam"], $rij["geboortedatum"], $rij["geslacht"]);
            $punt = new Punt($module, $persoon, (int) $rij["punt"]);
            array_push($lijst, $punt);
        }
        $dbh = null;
        return $lijst;
    }

    public function createPunt(int $moduleID, int $persoonID, int $punt)
    {
        $sql = "insert into punten (moduleID, persoonID, punt) values (:moduleID, :persoonID, :punt)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':moduleID' => $moduleID,
                ':persoonID' => $persoonID,
                ':punt' => $punt,
            )
        );
        $dbh = null;
    }

}