<?php
//Entities/Broodje.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class Broodje
{
    private int $broodjeid;
    private string $soort;
    private int $prijs;

    public function __construct(
        int $broodjeid,
        string $soort,
        int $prijs
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
    public function getPrijs(): int
    {
        return $this->prijs;
    }
    public function setSoort(string $soort)
    {
        $this->soort = $soort;
    }
    public function setPrijs(int $prijs)
    {
        $this->prijs = $prijs;
    }

}