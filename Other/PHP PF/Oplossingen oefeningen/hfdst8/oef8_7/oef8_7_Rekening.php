<?php
//rekening.php

declare(strict_types=1);

abstract class Rekening
{

    private string $rekeningnummer;
    private float $saldo = 0;

    public function getSaldo() : float
    {
        return $this->saldo;
    }

    public function stort(float $bedrag)
    {
        $this->saldo = $this->saldo + $bedrag;
    }

    public function setRekeningnummer(string $rekeningnummer)
    {
        $this->rekeningnummer = $rekeningnummer;
    }

    public abstract function voerIntrestDoor();
}
