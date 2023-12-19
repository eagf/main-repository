<?php
//FilmLijst.php

declare(strict_types=1);

require_once 'oef9_3_Film.php';

class FilmLijst
{

    public function getLijst() : array
    {
        $sql = "select id, titel, duurtijd from films order by titel";
        $dbh = new PDO(
            "mysql:host=localhost;dbname=cursusphp;charset=utf8",
            "cursusgebruiker",
            "cursuspwd"
        );

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lijst = array();
        foreach ($resultSet as $rij) {
            $film = new Film(
                (int) $rij["id"],
                $rij["titel"],
                (int) $rij["duurtijd"]
            );
            array_push($lijst, $film);
        }
        $dbh = null;
        return $lijst;
    }

    public function createFilm(string $titel, int $duurtijd)
    {
        if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)) {
            $sql = "insert into films (titel, duurtijd) values (:titel, :duurtijd)";
            $dbh = new PDO(
                "mysql:host=localhost;dbname=cursusphp;charset=utf8",
                "cursusgebruiker",
                "cursuspwd"
            );

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
        $dbh = new PDO(
            "mysql:host=localhost;dbname=cursusphp;charset=utf8",
            "cursusgebruiker",
            "cursuspwd"
        );

        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(
            ':id' => $id
        ));
        $dbh = null;
    }

}
