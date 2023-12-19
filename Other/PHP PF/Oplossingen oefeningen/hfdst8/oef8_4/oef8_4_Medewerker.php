<?php
//Medewerker.php

declare(strict_types=1);

require_once 'oef8_4_Persoon.php';

class Medewerker extends Persoon
{

    private int $aantalCursisten;

    public function getAantalCursisten() : int
    {
        return $this->aantalCursisten;
    }

    public function setAantalCursisten(int $aantalCursisten)
    {
        $this->aantalCursisten = $aantalCursisten;
    }

}
