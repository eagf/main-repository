<?php
//Spaarrekening.php

declare(strict_types=1);

require_once 'oef8_7_Rekening.php';

class Spaarrekening extends Rekening
{

    private static float $intrest = 0.03;

    public function __construct(string $rekeningnummer)
    {
        parent::setRekeningnummer($rekeningnummer);
    }

    public function voerIntrestDoor()
    {
        parent::stort(parent::getSaldo() * self::$intrest);
    }

}
