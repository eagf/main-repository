<?php
//BroodjesLijst.php

declare(strict_types=1);
require_once 'Broodje.php';

class BroodjesLijst
{
    private string $dbConn;
    private string $dbUsername;
    private string $dbPassword;

    public function __construct()
    {
        $this->dbConn = "mysql:host=localhost;dbname=broodjesbar;charset=utf8";
        $this->dbUsername = "root";
        $this->dbPassword = "";
    }

    public function getLijst() : array
    {
        $sql = "select ID, Naam, Omschrijving, Prijs from broodjes";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new Broodje((int)$rij["ID"], $rij["Naam"], $rij["Omschrijving"], (float)$rij["Prijs"]);
            array_push($lijst, $broodje);
        }
        $dbh = null;
        return $lijst;
    }

    public function getBroodjeByNaam(int $broodjeID) : string
    {
        $sql = "select naam from broodjes where ID = :broodjeID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':broodjeID' => $broodjeID
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij["naam"];        
    }   

    public function getIDBroodje($email) : int  // dit hoort hier niet thuis?
    {
        $sql = "select klantID from klanten where email = :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':email' => $email
            )
        );
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result["klantID"];
    }

}