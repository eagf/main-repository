<?php
//KlantenLijst.php

declare(strict_types=1);
require_once 'Klant.php';

class KlantenLijst
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
        $sql = "select klantID, voornaam, achternaam, email from klanten";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $klant = new Klant((int)$rij["klantID"], $rij["voornaam"], $rij["achternaam"], $rij["email"]);
            array_push($lijst, $klant);
        }
        $dbh = null;
        return $lijst;
    }

    public function getIDKlant($email) : int
    {
        $sql = "select * from klanten where email = :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':email' => $email
            )
        );
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);  // met controle where email kan je maar 1 record terugkrijgen

        $lijst = array();  // array overbodig
        foreach ($resultSet as $rij) {
            $klant = (int)$rij["klantID"];
            array_push($lijst, $klant);
        }
        $dbh = null;
        return (int)$lijst;
    }

    public function controleEmail(string $email)  // deze functie is idem aan onderstaande controleKlant(string $email)
    {
        $sql = "select email from klanten 
        where email = :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':email' => $email,
            )
        );
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultSet;
    }

    public function nieuweKlant(string $voornaam, string $achternaam, string $email)
    {
        $sql = "insert into klanten (voornaam, achternaam, email) values (:voornaam, :achternaam, :email)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':voornaam' => $voornaam,
                ':achternaam' => $achternaam,
                ':email' => $email
            )
        );
		
		// GEEF HIER LASTINSERTEDID TERUG
		
        $dbh = null;
    }

    public function controleKlant(string $email)  // deze functie is idem aan bovenstaande controleEmail(string $email)
    {
        $sql = "select email from klanten 
        where email = :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':email' => $email
            )
        );
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultSet;
    }

}

