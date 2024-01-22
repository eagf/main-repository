<?php
//Cursist.php

declare(strict_types=1);

require_once 'oef8_4_Persoon.php';

class Cursist extends Persoon
{

    private int $aantalCursussen;

    public function getAantalCursussen() : int
    {
        return $this->aantalCursussen;
    }

    public function setAantalCursussen(int $aantalCursussen)
    {
        $this->aantalCursussen = $aantalCursussen;
    }

}
