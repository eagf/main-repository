<?php
//Zichtrekening.php

declare(strict_types=1);

require_once 'oef8_7_'
. 'Rekening.php';

class Zichtrekening extends Rekening
{

    private static float $intrest = 0.025;

    public function __construct(string $rekeningnummer)
    {
        parent::setRekeningnummer($rekeningnummer);
    }

    public function voerIntrestDoor()
    {
        parent::stort(parent::getSaldo() * self::$intrest);
    }

}
