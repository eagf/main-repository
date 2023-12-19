<?php
declare(strict_types=1);

namespace Entities;

class Bestellijn
{
    private int $bestelId;
    private int $productId;
    private float $bestelPrijs;
    private bool $bestelPromo;
    private int $productAantal;

    public function __construct(
        int $bestelId,
        int $productId,
        float $bestelPrijs,
        bool $bestelPromo,
        int $productAantal
    ) 
    {
        $this->bestelId = $bestelId;
        $this->productId = $productId;
        $this->bestelPrijs = $bestelPrijs;
        $this->bestelPromo = $bestelPromo;
        $this->productAantal = $productAantal;
    }
    public function getBestelId(): int
    {
        return $this->bestelId;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getBestelPrijs(): float
    {
        return $this->bestelPrijs;
    }
    public function getBestelPromo(): bool
    {
        return $this->bestelPromo;
    }
    public function getProductAantal(): int
    {
        return $this->productAantal;
    }
}
