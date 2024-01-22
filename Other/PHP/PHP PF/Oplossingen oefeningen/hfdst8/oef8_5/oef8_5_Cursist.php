<?php
//Cursist.php

declare(strict_types=1);

require_once 'oef8_5_Persoon.php';

class Cursist extends Persoon
{

    private int $aantalCursussen;

    public function __construct(string $familienaam, string $voornaam, int $aantalCursussen)
    {
        parent::setFamilienaam($familienaam);
        parent::setVoornaam($voornaam);
        $this->aantalCursussen = $aantalCursussen;
    }

    public function getAantalCursussen() : int
    {
        return $this->aantalCursussen;
    }

    public function setAantalCursussen($aantalCursussen) : int
    {
        $this->aantalCursussen = $aantalCursussen;
    }

}
