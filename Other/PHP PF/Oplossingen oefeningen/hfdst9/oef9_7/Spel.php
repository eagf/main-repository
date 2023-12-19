<?php
//Spel.php

declare(strict_types=1);

class Spel
{
    private int $rijnummer;
    private int $kolomnummer;
    private int $status;

    public function __construct(int $rijnummer, int $kolomnummer, int $status)
    {
        $this->rijnummer = $rijnummer;
        $this->kolomnummer = $kolomnummer;        
        $this->status = $status;
    }

    public function getRijnummer() : int
    {
        return $this->rijnummer;
    }

    public function getKolomnummer() : int
    {
        return $this->kolomnummer;
    }

    public function getstatus() : int
    {
        return $this->status;
    }

    public function updateVeld() {

    }
}

class Veld
{
    private string $dbConn; 
    private string $dbUsername; 
    private string $dbPassword;

    public function __construct() { 
        $this->dbConn = "mysql:host=localhost;dbname=cursusphp;charset=utf8"; 
        $this->dbUsername = "cursusgebruiker"; 
        $this->dbPassword = "cursuspwd";
    }
    public function getVeld() : array
    {
        $sql = "select rijnummer, kolomnummer, status from vieropeenrij_spelbord";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $plaats = new Spel(
                (int) $rij["rijnummer"],
                (int) $rij["kolomnummer"],
                (int) $rij["status"]
            );
            array_push($lijst, $plaats);
        }
        $dbh = null;
        return $lijst;
    }
    public function updateVeld(int $kolom, int $kleur) { 
        $sql = "update vieropeenrij_spelbord set status = :status 
        where status = 0 and kolomnummer = :kolomnummer order by rijnummer desc limit 1"; 
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword); 
        $stmt = $dbh->prepare($sql); 
        
        $stmt->execute(array( ":status" => $kleur,":kolomnummer" => $kolom)); 
        $dbh = null;
    }

    public function resetVeld() {
        $sql = "update vieropeenrij_spelbord set status = 0"; 
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword); 
        $stmt = $dbh->prepare($sql); 
        $stmt->execute();
        $dbh = null;
    }

} 
          