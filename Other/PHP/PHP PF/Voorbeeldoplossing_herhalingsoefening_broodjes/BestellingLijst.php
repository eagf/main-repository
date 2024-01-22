<?php
//BestellingLijst.php

declare(strict_types=1);
require_once 'Bestelling.php';
require_once 'Gebruiker.php';
require_once 'Broodje.php';

class BestellingLijst
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

    public function getLijst() : array
    {
        $sql = "select bestellingen.id, datumtijd, gebruikers.id, gebruikers.naam as gebruikernaam, email, wachtwoord, geblokkeerd, broodjes.id, broodjes.naam as broodjesnaam, omschrijving, prijs from bestellingen, broodjes, gebruikers where broodid = broodjes.id and gebrid = gebruikers.id order by datumtijd desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $gebruiker = new Gebruiker((int)$rij["id"], $rij["gebruikernaam"], $rij["email"], $rij["wachtwoord"], (int)$rij["geblokkeerd"]);
            $broodje = new Broodje((int)$rij["id"], $rij["broodjesnaam"], $rij["omschrijving"], (float)$rij["prijs"]);
            $bestelling = new Bestelling((int)$rij["id"], $rij["datumtijd"], $gebruiker, $broodje);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }
	
    public function createBestelling(int $gebrid, int $broodid)
    {
		$datumtijd = date("Y-m-d H:i:s");
        $sql = "insert into bestellingen (datumtijd, gebrid, broodid) values (:datumtijd, :gebrid, :broodid)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':datumtijd' => $datumtijd,
            ':gebrid' => $gebrid,
            ':broodid' => $broodid,
        ));
        $dbh = null;
    } 	

}
