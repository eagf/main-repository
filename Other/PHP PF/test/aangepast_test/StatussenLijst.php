<?php
//StatussenLijst.php

declare(strict_types=1);
require_once 'Status.php';

class StatussenLijst
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
        $sql = "select statusID, Status from statussen";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $status = new Status((int)$rij["statusID"], $rij["Status"]);
            array_push($lijst, $status);
        }
        $dbh = null;
        return $lijst;
    }

}

