<?php
declare(strict_types=1);

namespace Entities;

class Product
{
    private int $productId;
    private string $productNaam;
    private float $productPrijs;
    private float $productPromotieprijs;
    private string $productSamenstelling;
    private bool $productBeschikbaarheid;

    public function __construct(
        int $productId,
        string $productNaam,
        float $productPrijs,
        float $productPromotieprijs,
        string $productSamenstelling,
        bool $productBeschikbaarheid
    ) 
    {
        $this->productId = $productId;
        $this->productNaam = $productNaam;
        $this->productPrijs = $productPrijs;
        $this->productPromotieprijs = $productPromotieprijs;
        $this->productSamenstelling = $productSamenstelling;
        $this->productBeschikbaarheid = $productBeschikbaarheid;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getProductNaam(): string
    {
        return $this->productNaam;
    }
    public function getProductprijs(): float
    {
        return $this->productPrijs;
    }
    public function getProductPromotieprijs(): float
    {
        return $this->productPromotieprijs;
    }
    public function getProductSamenstelling(): string
    {
        return $this->productSamenstelling;
    }
    public function getProductBeschikbaarheid(): bool
    {
        return $this->productBeschikbaarheid;
    }
    
}
