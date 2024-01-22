<?php
//BestellingenLijst.php

declare(strict_types=1);
require_once 'Broodje.php';
require_once 'Klant.php';
require_once 'Status.php';
require_once 'Bestelling.php';

class BestellingenLijst
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

    public function getLijst(): array
    {
        //$sql = "select bestelID, broodjes.ID as broodjeID, klanten.klantID, afhalingsmoment, statussen.statusID, Naam, Omschrijving, Prijs, voornaam, achternaam, email, Status from broodjes, klanten, statussen, bestellingen where bestellingen.broodjeID = broodjes.ID and bestellingen.klantID = klanten.klantID and bestellingen.statusID = statussen.statusID order by afhalingsmoment";
		
		// haal enkel de bestellingen op met status 1 of status 2, dus where statusid <> 3
		$sql = "select * from broodjes, klanten, statussen, bestellingen where (bestellingen.broodjeID = broodjes.ID) and (bestellingen.klantID = klanten.klantID) and (bestellingen.statusID = statussen.statusID) and (bestellingen.statusID <> 3) order by afhalingsmoment";
        
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*		
echo "<pre>";
var_dump($resultSet);		
echo "</pre>";		
*/		

        $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new Broodje((int) $rij["broodjeID"], $rij["Naam"], $rij["Omschrijving"], (float) $rij["Prijs"]);
            $klant = new Klant((int) $rij["klantID"], $rij["voornaam"], $rij["achternaam"], $rij["email"]);
            $bestelling = new Bestelling((int) $rij["bestelID"], $broodje, $klant, $rij["afhalingsmoment"], $rij["statusID"]);
            array_push($lijst, $bestelling);
        }
        $dbh = null;
        return $lijst;
    }

    public function createBestelling(int $klantID, int $broodjeID, string $afhalingsmoment)
    {
        
        $sql = "insert into bestellingen (broodjeID, klantID, afhalingsmoment, statusID) values (:broodjeID, :klantID, :afhalingsmoment, :statusID)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':klantID' => $klantID,
            ':broodjeID' => $broodjeID,
            ':afhalingsmoment' => $afhalingsmoment,
            ':statusID' => 1,
        ));
        $dbh = null;
    }  

    public function updateStatus(int $bestelID)
    {

        $sql = "update bestellingen set statusID = statusID + 1 where bestelID = :bestelID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':bestelID' => $bestelID
        ));
        $dbh = null;

        
    }  

}