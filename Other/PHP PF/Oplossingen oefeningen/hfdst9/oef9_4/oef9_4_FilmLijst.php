<?php
//FilmLijst.php

declare(strict_types=1);

require_once 'oef9_4_Film.php';

class FilmLijst
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

    public function getLijst() : array
    {
        $sql = "select id, titel, duurtijd from films order by titel";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $film = new Film((int)$rij["id"], $rij["titel"], (int) $rij["duurtijd"]);
            array_push($lijst, $film);
        }
        $dbh = null;
        return $lijst;
    }

    public function getFilmById(int $id) : Film
    {
        $sql = "select titel, duurtijd from films where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $film = new Film((int)$id, $rij["titel"], (int)$rij["duurtijd"]);
        $dbh = null;
        return $film;
    }

    public function updateFilm(Film $film)
    {
        $sql = "update films set titel = :titel, duurtijd = :duurtijd where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':titel' => $film->getTitel(),
            ':duurtijd' => $film->getDuurtijd(),
            ':id' => $film->getId()
        ));
        $dbh = null;
    }

    public function createFilm(string $titel, int $duurtijd)
    {
        if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)) {
            $sql = "insert into films (titel, duurtijd) values (:titel, :duurtijd)";
            $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(
                ':titel' => $titel,
                ':duurtijd' => $duurtijd
            ));
            $dbh = null;
        }
    }

    public function deleteFilm(int $id)
    {
        $sql = "delete from films where id = :id";
        $dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        $dbh = null;
    }

}
