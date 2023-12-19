<?php
//rekening.php

declare(strict_types=1);

class Rekening
{

    private static float $intrest = 0.03;
    private string $rekeningnummer;
    private float $saldo;

    public function __construct(string $rekeningnummer)
    {
        $this->rekeningnummer = $rekeningnummer;
        $this->saldo = 0;
    }

    public function getSaldo() : float
    {
        return $this->saldo;
    }

    public function stort(float $bedrag)
    {
        $this->saldo = $this->saldo + $bedrag;
    }

    public function voerIntrestDoor()
    {
        $this->saldo = $this->saldo + ($this->saldo * self::$intrest);
    }

}
