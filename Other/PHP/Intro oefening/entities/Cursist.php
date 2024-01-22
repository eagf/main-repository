<?php
//entities/Cursist.php 

declare(strict_types=1);
class Cursist
{
    private int $id;
    private string $familienaam;
    private string $voornaam;

    public function __construct(int $id, string $familienaam, string $voornaam)
    {
        $this->id = $id;
        $this->setFamilienaam($familienaam);
        $this->setVoornaam($voornaam);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFamilienaam(): string
    {
        return $this->familienaam;
    }

    public function getVoornaam(): string
    {
        return $this->voornaam;
    }

    public function setFamilienaam(string $familienaam)
    {
        $this->familienaam = $familienaam;
    }
    
    public function setVoornaam(string $voornaam)
    {
        $this->voornaam = $voornaam;
    }
}
