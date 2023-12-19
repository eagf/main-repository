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

    public function registreer($naam, $voornaam, $email, $wachtwoord, $herhaalwachtwoord)
    {
        $this->klantDAO->registreer($naam, $voornaam, $email, $wachtwoord, $herhaalwachtwoord);
    }

    public function login($email, $wachtwoord): ?Klant
    {
        return $this->klantDAO->login($email, $wachtwoord);
    }
}
