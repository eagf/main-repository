<?php
//Module.php

declare(strict_types=1);

class Module
{
    private int $moduleid;
    private string $naam;

    public function __construct(int $moduleid, string $naam)
    {
        $this->moduleid = $moduleid;
        $this->naam = $naam;
    }

    public function getId() : int
    {
        return $this->moduleid;
    }

    public function getNaam() : string
    {
        return $this->naam;
    }

}