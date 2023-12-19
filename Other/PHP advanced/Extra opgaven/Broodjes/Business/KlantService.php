<?php

declare(strict_types=1);

namespace Business;

use Data\KlantDAO;
use Entities\Klant;

class KlantService
{
    private KlantDAO $klantDAO;
    public function __construct()
    {
        $this->klantDAO = new klantDAO();
    }

    public function registreer($naam, $voornaam, $email, $wachtwoord)
    {
        $this->klantDAO->registreer($naam, $voornaam, $email, $wachtwoord);
    }

    public function login($email, $wachtwoord): ?Klant
    {
        return $this->klantDAO->login($email, $wachtwoord);
    }

    public function updateWachtwoord($email, $wachtwoord)
    {
        $this->klantDAO->updateWachtwoord($email, $wachtwoord);
    }

    public function willekeurigWachtwoord(): string
    {
        $tekens = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $wachtwoord = "";
        for ($i = 0; $i < 4; $i++) {
            $index = rand(0, strlen($tekens) - 1);
            $wachtwoord .= $tekens[$index];
        }
        return $wachtwoord;
    } 
}