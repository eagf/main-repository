<?php

declare(strict_types=1);

require_once('Data/autoloader.php');

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
