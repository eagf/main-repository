<?php
//data.UserDAO.php

declare(strict_types=1);

require_once("entities/User.php");

class UserDAO {

    public function getUserByName(string $gebruikersnaam) : ?User {
        $sql = "select id, gebruikersnaam, wachtwoord from gebruikers where gebruikersnaam = :naam";
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':naam' => $gebruikersnaam));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if ($rij) { 
            $user = new User((int)$rij["id"], $rij["gebruikersnaam"], $rij["wachtwoord"]);
            $dbh = null;
        } 
        return $user;
    }

}
