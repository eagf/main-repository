<?php
//business/UserService.php

declare(strict_types=1);

class UserService {

    public function controleerGebruiker(string $gebruikersnaam, string $wachtwoord): bool {
        if ($gebruikersnaam === "admin" && $wachtwoord === "geheim"){
            return true;
        }
        else {
            return false;
        }
    }

}
