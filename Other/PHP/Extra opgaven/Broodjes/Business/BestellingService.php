<?php

declare(strict_types=1);

namespace Business;

use Data\BestellingDAO;
use Entities\Bestelling;
use Entities\Broodje;
use Entities\Beleg;

class BestellingService
{
    private BestellingDAO $bestellingDAO;
    public function __construct()
    {
        $this->bestellingDAO = new BestellingDAO();
    }

    public function create($klantid, $broodjeid, $belegSoorten, $valseTijd, $totaalprijs)
    {
        $this->bestellingDAO->create($klantid, $broodjeid, $belegSoorten, $valseTijd, $totaalprijs);
    }
    public function getBestellingenByKlantId(int $klantid): array
    {
        return $this->bestellingDAO->getBestellingenByKlantId($klantid);
    }
    public function getBroodjeByBestelId(int $bestelid): ?Broodje
    {
        return $this->bestellingDAO->getBroodjeByBestelId($bestelid);
    }
    public function getBelegSoortenByBestelId(int $bestelid): ?array
    {
        return $this->bestellingDAO->getBelegSoortenByBestelId($bestelid);
    }
    
}
