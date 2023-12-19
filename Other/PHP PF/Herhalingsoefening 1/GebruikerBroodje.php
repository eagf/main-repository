<?php
//GebruikerBroodje.php

declare(strict_types=1);

class Gebruiker
{

    private int $ID;
    private string $Naam;
    private string $emailadres;
    private string $wachtwoord;
    private int $geblokkeerd;

    public function __construct(int $ID, string $Naam, string $emailadres, string $wachtwoord, int $geblokkeerd)
    {
        $this->ID = $ID;
        $this->Naam = $Naam;
        $this->emailadres = $emailadres;
        $this->wachtwoord = $wachtwoord;
        $this->geblokkeerd = $geblokkeerd;
    }

    public function getID(): int
    {
        return $this->ID;
    }

    public function getNaam(): string
    {
        return $this->Naam;
    }

    public function getEmailadres(): string
    {
        return $this->emailadres;
    }

    public function getWachtwoord(): string
    {
        return $this->wachtwoord;
    }

    public function getGeblokkeerd(): int
    {
        return $this->geblokkeerd;
    }
}

class Broodje
{

    private int $ID;
    private string $Naam;
    private string $Omschrijving;
    private float $Prijs;

    public function __construct(int $ID, string $Naam, string $Omschrijving, float $Prijs)
    {
        $this->ID = $ID;
        $this->Naam = $Naam;
        $this->Omschrijving = $Omschrijving;
        $this->Prijs = $Prijs;
    }

    public function getID(): int
    {
        return $this->ID;
    }

    public function getNaam(): string
    {
        return $this->Naam;
    }

    public function getOmschrijving(): string
    {
        return $this->Omschrijving;
    }

    public function getPrijs(): float
    {
        return $this->Prijs;
    }
}

class BesteldBroodje
{

    private int $ID;
    private string $gebruikerID;
    private string $broodjesID;

    public function __construct(int $ID, string $gebruikerID, string $broodjesID)
    {
        $this->ID = $ID;
        $this->gebruikerID = $gebruikerID;
        $this->broodjesID = $broodjesID;
    }

    public function getID(): int
    {
        return $this->ID;
    }

    public function getGebruikersID(): string
    {
        return $this->gebruikerID;
    }

    public function getBroodjesID(): string
    {
        return $this->broodjesID;
    }
}

class GebruikersLijst
{
    private string $dbConn;
    private string $dbUsername;
    private string $dbPassword;

    public function __construct()
    {
        $this->dbConn = "mysql:host=localhost;dbname=broodjesbar;charset=utf8";
        $this->dbUsername = "cursusgebruiker";
        $this->dbPassword = "cursuspwd";
    }

    public function getLijst(): array
    {
        $sql = "select * from gebruikers";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $gebruiker = new Gebruiker((int) $rij["ID"], (string) $rij["Naam"], (string) $rij["emailadres"], (string) $rij["wachtwoord"], (int) $rij["geblokkeerd"]);
            array_push($lijst, $gebruiker);
        }
        $dbh = null;
        return $lijst;
    }

    public function nieuweGebruiker(string $naam, string $emailadres, string $wachtwoord)
    {
        $sql = "insert into gebruikers (naam, emailadres, wachtwoord) values (:naam, :emailadres, :wachtwoord)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':naam' => $naam,
                ':emailadres' => $emailadres,
                ':wachtwoord' => $wachtwoord
            )
        );
        $dbh = null;
    }

    public function controleEmailadres(string $emailadres)
    {
        $sql = "select emailadres from gebruikers 
        where emailadres = :emailadres";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':emailadres' => $emailadres,
            )
        );
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultSet;
    }

    public function controleGebruiker(string $emailadres, string $wachtwoord)
    {
        $sql = "select emailadres, wachtwoord from gebruikers 
        where (emailadres = :emailadres and wachtwoord = :wachtwoord)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':emailadres' => $emailadres,
                ':wachtwoord' => $wachtwoord
            )
        );
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultSet;
    }

    public function getIDGebruiker(string $emailadres)
    {
        $sql = "select ID from gebruikers 
        where emailadres = :emailadres";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':emailadres' => $emailadres
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["ID"];
    }

    public function getNaamGebruiker(int $gebruikerID)
    {
        $sql = "select naam from gebruikers 
        where ID = :gebruikerID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':gebruikerID' => $gebruikerID
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["naam"];
    }

    public function getGeblokkeerd(string $emailadres)
    {
        $sql = "select geblokkeerd from gebruikers 
        where emailadres = :emailadres";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':emailadres' => $emailadres
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["geblokkeerd"];
    }

}

class BroodjesLijst
{
    private string $dbConn;
    private string $dbUsername;
    private string $dbPassword;

    public function __construct()
    {
        $this->dbConn = "mysql:host=localhost;dbname=broodjesbar;charset=utf8";
        $this->dbUsername = "cursusgebruiker";
        $this->dbPassword = "cursuspwd";
    }

    public function getBroodjesLijst(): array
    {
        $sql = "select * from broodjes";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new Broodje((int) $rij["ID"], (string) $rij["Naam"], (string) $rij["Omschrijving"], (float) $rij["Prijs"]);
            array_push($lijst, $broodje);
        }
        $dbh = null;
        return $lijst;
    }

    public function getBesteldeBroodjesLijst(): array
    {
        $sql = "select * from besteldebroodjes";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $broodje = new BesteldBroodje((int) $rij["ID"], (string) $rij["gebruikersID"], (string) $rij["broodjesID"]);
            array_push($lijst, $broodje);
        }
        $dbh = null;
        return $lijst;
    }

    public function getBroodjeNaam(int $broodjesID) 
    {
        $sql = "select naam from broodjes where ID = :broodjesID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':broodjesID' => $broodjesID
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["naam"];
    }

    public function getAantalBroodjes(int $broodjesID) 
    {
        $sql = "select count(*) from besteldebroodjes where broodjesID = :broodjesID";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':broodjesID' => $broodjesID
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result["count(*)"];
    }

    public function toevoegenBroodje(int $gebruikerID, int $broodjesID)
    {
        $sql = "insert into besteldebroodjes (gebruikersID, broodjesID) values (:gebruikersID, :broodjesID)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':gebruikersID' => $gebruikerID,
                ':broodjesID' => $broodjesID
            )
        );
        $dbh = null;
    }
}