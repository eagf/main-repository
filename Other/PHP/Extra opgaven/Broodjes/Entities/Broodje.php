<?php
//Entities/Broodje.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class Broodje
{
    private int $broodjeid;
    private string $soort;
    private float $prijs;

    public function __construct(
        int $broodjeid,
        string $soort,
        float $prijs
    ) {
        $this->broodjeid = $broodjeid;
        $this->soort = $soort;
        $this->prijs = $prijs;
    }
    public function getBroodjeid(): int
    {
        return $this->broodjeid;
    }
    public function getSoort(): string
    {
        return $this->soort;
    }
    public function getPrijs(): float
    {
        return $this->prijs;
    }
    public function setSoort(string $soort)
    {
        $this->soort = $soort;
    }
    public function setPrijs(float $prijs)
    {
        $this->prijs = $prijs;
    }

}