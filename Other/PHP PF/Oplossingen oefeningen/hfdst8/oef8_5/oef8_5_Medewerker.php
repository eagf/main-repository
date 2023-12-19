<?php
//Medewerker.php

declare(strict_types=1);

require_once 'oef8_5_Persoon.php';

class Medewerker extends Persoon
{

    private int $aantalCursisten;

    public function __construct(string $familienaam, string $voornaam, int $aantalCursisten)
    {
        parent::setFamilienaam($familienaam);
        parent::setVoornaam($voornaam);
        $this->aantalCursisten = $aantalCursisten;
    }

    public function getAantalCursisten() : int
    {
        return $this->aantalCursisten;
    }

    public function setAantalCursisten(int $aantalCursisten)
    {
        $this->aantalCursisten = $aantalCursisten;
    }

}
