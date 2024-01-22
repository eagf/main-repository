<?php
//Module.php

declare(strict_types=1);

class Module
{
    private int $id;
    private string $naam;
    private int $prijs;

    public function __construct(int $id, string $naam, int $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getPrijs(): int
    {
        return $this->prijs;
    }


}