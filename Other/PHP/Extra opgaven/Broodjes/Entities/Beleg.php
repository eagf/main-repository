<?php
//Entities/Beleg.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class Beleg
{
    private int $belegid;
    private string $soort;
    private float $prijs;

    public function __construct(
        int $belegid,
        string $soort,
        float $prijs
    ) {
        $this->belegid = $belegid;
        $this->soort = $soort;
        $this->prijs = $prijs;
    }
    public function getBelegid(): int
    {
        return $this->belegid;
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