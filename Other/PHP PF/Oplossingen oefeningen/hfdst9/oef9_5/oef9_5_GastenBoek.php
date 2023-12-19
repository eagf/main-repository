<?php
//Gastenboek.php

declare(strict_types=1);

require_once("oef9_5_Bericht.php");

class GastenBoek
{

    private string $dbConn;
    private string $dbUsername;
    private string $dbPassword;

    public function __construct()
    {
        $this->dbConn = "mysql:host=localhost;dbname=cursusphp;charset=utf8";
        $this->dbUsername = "cursusgebruiker";
        $this->dbPassword = "cursuspwd";
    }

    public function getAlleBerichten() : array
    {
        $sql = "select id, auteur, boodschap, datum from gastenboek";
//        $sql = "select id, auteur, boodschap, datum from gastenboek order by datum desc";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $resultSet = $dbh->query($sql);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $bericht = new Bericht(
                (int) $rij["id"],
                $rij["auteur"],
                $rij["boodschap"],
                $rij["datum"]
            );
            array_push($lijst, $bericht);
        }
        $dbh = null;
        return $lijst;
    }

    public function createBericht(string $auteur, string $boodschap)
    {
        $sql = "insert into gastenboek (auteur, boodschap, datum) values (:auteur, :boodschap, :datum)";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $datum = date("Y-m-d H:i:s");
        $stmt->execute(array(
            ':auteur' => $auteur,
            ':boodschap' => $boodschap,
            ':datum' => $datum
        ));
        $dbh = null;
    }

}
