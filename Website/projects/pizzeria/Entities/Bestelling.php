<?php
declare(strict_types=1);

require_once('Data/autoloader.php');

class Bestelling
{
    private int $bestelId;
    private int $klantId;
    private string $bestelDatumTijd;
    private string $bestelInfo;

    public function __construct(
        int $bestelId,
        int $klantId,
        string $bestelDatumTijd,
        string $bestelInfo
    ) 
    {
        $this->bestelId = $bestelId;
        $this->klantId = $klantId;
        $this->bestelDatumTijd = $bestelDatumTijd;
        $this->bestelInfo = $bestelInfo;
    }
    public function getBestelId(): int
    {
        return $this->bestelId;
    }
    public function getKlantId(): int
    {
        return $this->klantId;
    }
    public function getBestelDatumTijd(): string
    {
        return $this->bestelDatumTijd;
    }
    public function getBestelInfo(): string
    {
        return $this->bestelInfo;
    }
    
}
