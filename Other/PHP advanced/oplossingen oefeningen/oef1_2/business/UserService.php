<?php
//business/UserService.php

declare(strict_types=1);

require_once("entities/User.php");
require_once("data/UserDAO.php");

class UserService {

    public function controleerGebruiker(string $gebruikersnaam, string $wachtwoord): bool {
        
        $userDAO = new UserDAO();
        $user = $userDAO->getUserByName($gebruikersnaam);
        if (isset($user) && ($user->getWachtwoord() === $wachtwoord)){
            return true;
        }
        else {
            return false;
        }
        
    }
}
