<?php

declare(strict_types=1);

namespace Business;

use Data\PlaatsDAO;
use Entities\Klant;
use Entities\Plaats;

class PlaatsService
{
    private PlaatsDAO $plaatsDAO;
    public function __construct()
    {
        $this->plaatsDAO = new PlaatsDAO();
    }
    public function getAll(): ?array 
    {
        return $this->plaatsDAO->getAll();
    }
    public function getPlaatsByKlantId($klantId): ?Plaats
    {
        return $this->plaatsDAO->getPlaatsByKlantId($klantId);
    }
}
