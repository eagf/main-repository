<?php
//GebruikerLijst.php

declare(strict_types=1);
require_once 'Gebruiker.php';

class GebruikerLijst
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
	
    public function loginGebruiker(string $email, string $wachtwoord) : Gebruiker|bool
    {
		// indien gebruiker bestaat en met correcte login, geef Gebruiker terug, anders false
		$gebruiker = false;
        $sql = "select id, naam, email, wachtwoord, geblokkeerd from gebruikers where email= :email and wachtwoord= :wachtwoord";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email,
			':wachtwoord' => $wachtwoord
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($rij) {
            $gebruiker = new Gebruiker((int)$rij["id"], $rij["naam"], $rij["email"], $rij["wachtwoord"], (int)$rij["geblokkeerd"]);
		}
        $dbh = null;
        return $gebruiker;
    }	

	/*
    public function getGebruiker(string $email) : Gebruiker
    {
        $sql = "select id, naam, email, wachtwoord, geblokkeerd from gebruikers where email= :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
		
        $gebruiker = new Gebruiker((int)$rij["id"], $rij["naam"], $rij["email"], $rij["wachtwoord"], (int)$rij["geblokkeerd"]);
        $dbh = null;
        return $gebruiker;
    }
	*/
	
    public function createGebruiker(string $naam, string $email, string $wachtwoord) : int
    {
		 // we geven elke gebruiker bij default een niet-geblokkeerd account
            $sql = "insert into gebruikers (naam, email, wachtwoord, geblokkeerd) values (:naam, :email, :wachtwoord, 0)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':naam' => $naam,
                ':email' => $email,
				':wachtwoord' => $wachtwoord,
            ));
		    $laatsteId = $dbh->lastInsertId();
            $dbh = null;
		    return (int)$laatsteId;
    }  
    	
    public function emailExists(string $email) : bool
    {
        $sql = "select * from gebruikers where email = :email";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':email' => $email
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $gevonden = !$rij ? false : true;
         $dbh = null;
        return $gevonden;
    } 	
	
	

}
