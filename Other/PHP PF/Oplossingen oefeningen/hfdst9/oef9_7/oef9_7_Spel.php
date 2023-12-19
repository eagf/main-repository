<?php
//Spel.php

declare(strict_types=1);

class Spel
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

    public function getStatus(int $rij, int $kolom) : int
    {
        $sql = "select status from vieropeenrij_spelbord where rijnummer = :rij and kolomnummer = :kolom";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':rij' => $rij,
            ':kolom' => $kolom
        ));
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultSet) {
            $dbh = null;
            return (int) $resultSet["status"];
        }
    }

    public function gooiMunt(int $kolom, int $status) : bool
    {
        //zoek een beschikbare rij
        $gevondenRij = -1;
        $i = 6;
        while ($gevondenRij === -1 && $i >= 0) {
            if ($this->getStatus($i, $kolom) === 0) {
                $gevondenRij = $i;
            } else {
                $i--;
            }
        }

        if ($gevondenRij !== -1) {
            $sql = "update vieropeenrij_spelbord set status = :status where rijnummer = :gevondenRij and kolomnummer = :kolom";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':status' => $status,
                'gevondenRij' => $gevondenRij,
                ':kolom' => $kolom
            ));
            $dbh = null;
            return true;
        } else
            return false;
    }

    public function reset()
    {
        $sql = "update vieropeenrij_spelbord set status = 0";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
        $dbh->exec($sql);
        $dbh = null;
    }

}
