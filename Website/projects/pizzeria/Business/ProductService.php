<?php

declare(strict_types=1);

namespace Business;

use Data\ProductDAO;
use Entities\Product;

class ProductService
{
    private ProductDAO $productDAO;
    public function __construct()
    {
        $this->productDAO = new ProductDAO();
    }

    public function getAll(): ?array
    {
        return $this->productDAO->getAll();
    }
    public function getProductByProductId(int $productId): ?Product
    {
        return $this->productDAO->getProductByProductId($productId);
    }
    public function getIndexWinkelmandLijstByProductId($winkelmandLijst, $productId): ?int
    {
        $index = 0;
        if (!empty($winkelmandLijst)) {
            foreach ($winkelmandLijst as $rij) {
                if ($rij["productId"] === $productId) {
                    return $index;
                }
                $index += 1;
            }
            return null;
        }
        return null;
    }
}
