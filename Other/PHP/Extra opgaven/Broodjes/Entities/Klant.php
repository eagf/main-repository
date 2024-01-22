<?php
//Entities/Klant.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class Klant
{
    private int $klantid;
    private string $naam;
    private string $voornaam;
    private string $email;
    private string $wachtwoord;

    public function __construct(
        int $klantid,
        string $naam,
        string $voornaam,
        string $email,
        string $wachtwoord
    ) 
    {
        $this->klantid = $klantid;
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
    }
    public function getKlantid(): int
    {
        return $this->klantid;
    }
    public function getNaam(): string
    {
        return $this->naam;
    }
    public function getVoornaam(): string
    {
        return $this->voornaam;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getWachtwoord(): string
    {
        return $this->wachtwoord;
    }
    public function setNaam(string $naam)
    {
        $this->naam = $naam;
    }
    public function setVoornaam(string $voornaam)
    {
        $this->voornaam = $voornaam;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setWachtwoord(string $wachtwoord)
    {
        $this->wachtwoord = $wachtwoord;
    }
}
