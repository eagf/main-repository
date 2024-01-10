<?php
declare(strict_types=1);

namespace Entities;

class Klant
{
    private int $klantId;
    private string $klantNaam;
    private string $klantVoornaam;
    private string $klantStraat;
    private int $klantHuisnummer;
    private int $plaatsId;
    private int $klantTelefoonnummer;
    private string $klantEmail;
    private string $klantWachtwoord;
    private string $klantInfo;
    private int $klantPromo;

    public function __construct(
        int $klantId,
        string $klantNaam,
        string $klantVoornaam,
        string $klantStraat,
        int $klantHuisnummer,
        int $plaatsId,
        int $klantTelefoonnummer,
        string $klantEmail,
        string $klantWachtwoord,
        string $klantInfo,
        int $klantPromo
    ) 
    {
        $this->klantId = $klantId;
        $this->klantNaam = $klantNaam;
        $this->klantVoornaam = $klantVoornaam;
        $this->klantStraat = $klantStraat;
        $this->klantHuisnummer = $klantHuisnummer;
        $this->plaatsId = $plaatsId;
        $this->klantTelefoonnummer = $klantTelefoonnummer;
        $this->klantEmail = $klantEmail;
        $this->klantWachtwoord = $klantWachtwoord;
        $this->klantInfo = $klantInfo;
        $this->klantPromo = $klantPromo;

    }
    public function getKlantId(): int
    {
        return $this->klantId;
    }
    public function getKlantNaam(): string
    {
        return $this->klantNaam;
    }
    public function getKlantVoornaam(): string
    {
        return $this->klantVoornaam;
    }
    public function getKlantStraat(): string
    {
        return $this->klantStraat;
    }
    public function getKlantHuisnummer(): int
    {
        return $this->klantHuisnummer;
    }
    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }
    public function getKlantTelefoonnummer(): int
    {
        return $this->klantTelefoonnummer;
    }
    public function getKlantEmail(): string
    {
        return $this->klantEmail;
    }
    public function getKlantWachtwoord(): string
    {
        return $this->klantWachtwoord;
    }
    public function getKlantInfo(): string
    {
        return $this->klantInfo;
    }
    public function getKlantPromo(): int
    {
        return $this->klantPromo;
    }
}
