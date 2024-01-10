<?php

declare(strict_types=1);

namespace Business;

use Data\BestellingDAO;

use Entities\Bestelling;
use Entities\Klant;

class BestellingService
{
    private BestellingDAO $bestellingDAO;
    public function __construct()
    {
        $this->bestellingDAO = new BestellingDAO();
    }
    public function createBestelling(Klant $klant, $bestelInfo, $winkelmandLijst) 
    {
        $this->bestellingDAO->createBestelling($klant, $bestelInfo, $winkelmandLijst);
    }

}