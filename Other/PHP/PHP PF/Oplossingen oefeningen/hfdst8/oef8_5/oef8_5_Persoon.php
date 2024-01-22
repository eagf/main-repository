<?php
//Persoon.php

declare(strict_types=1);

class Persoon
{

    private string $familienaam;
    private string $voornaam;

    public function getVollNaam() : string
    {
        return $this->familienaam . ", " . $this->voornaam;
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
