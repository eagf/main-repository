<?php
//Persoon.php

declare(strict_types=1);

class Persoon
{
    private int $id;
    private string $familienaam;
    private string $voornaam;
    private string $geboortedatum;
    private string $geslacht;

    public function __construct(int $id, string $familienaam, string $voornaam, string $geboortedatum, string $geslacht)
    {
        $this->id = $id;
        $this->familienaam = $familienaam;
        $this->voornaam = $voornaam;
        $this->geboortedatum = $geboortedatum;
        $this->geslacht = $geslacht;
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

    public function getGeboortedatum(): string
    {
        return $this->geboortedatum;
    }

    public function getGeslacht(): string
    {
        return $this->geslacht;
    }

}