<?php

declare(strict_types=1);

namespace Business;

use Data\KlantDAO;
use Entities\Klant;
use Entities\Plaats;

class KlantService
{
    private KlantDAO $klantDAO;
    public function __construct()
    {
        $this->klantDAO = new KlantDAO();
    }
    public function registreer(
        $naam,
        $voornaam,
        $straat,
        $huisnummer,
        $postcode,
        $telefoonnummer,
        $email,
        $wachtwoord,
        $herhaalwachtwoord,
        $info
    ): ?Klant {
        return $this->klantDAO->registreer(
            $naam,
            $voornaam,
            $straat,
            $huisnummer,
            $postcode,
            $telefoonnummer,
            $email,
            $wachtwoord,
            $herhaalwachtwoord,
            $info
        );
    }
    public function login($email, $wachtwoord): ?Klant
    {
        return $this->klantDAO->login($email, $wachtwoord);
    }
    public function updateWachtwoord($email, $wachtwoord)
    {
        $this->klantDAO->updateWachtwoord($email, $wachtwoord);
    }
    public function getKlantByKlantId($klantId): ?Klant
    {
        return $this->klantDAO->getKlantByKlantId($klantId);
    }
    public function updateKlant(
        $naam,
        $voornaam,
        $straat,
        $huisnummer,
        $postcode,
        $telefoonnummer,
        $info,
        $klantId
    ): ?Klant
    {
        return $this->klantDAO->updateKlant(
            $naam,
            $voornaam,
            $straat,
            $huisnummer,
            $postcode,
            $telefoonnummer,
            $info,
            $klantId
        );
    }
    public function toggleKlantPromoByKlantId($klantId): ?Klant
    {
        return $this->klantDAO->toggleKlantPromoByKlantId($klantId);
    }
}
