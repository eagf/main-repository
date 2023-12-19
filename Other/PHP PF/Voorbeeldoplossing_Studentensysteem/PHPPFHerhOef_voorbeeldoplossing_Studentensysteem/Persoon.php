<?php
//Persoon.php

declare(strict_types=1);

class Persoon
{
    private int $persoonid;
    private string $naam;

    public function __construct(int $persoonid, string $naam)
    {
        $this->persoonid = $persoonid;
        $this->naam = $naam;
    }

    public function getId() : int
    {
        return $this->persoonid;
    }

    public function getNaam() : string
    {
        return $this->naam;
    }

}