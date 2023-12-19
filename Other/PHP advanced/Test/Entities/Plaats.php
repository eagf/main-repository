<?php
declare(strict_types=1);

namespace Entities;

class Plaats
{
    private int $plaatsId;
    private string $postcode;
    private string $woonplaats;
    private int $isLeverbaar;

    public function __construct(
        int $plaatsId,
        string $postcode,
        string $woonplaats,
        int $isLeverbaar
    ) 
    {
        $this->plaatsId = $plaatsId;
        $this->postcode = $postcode;
        $this->woonplaats = $woonplaats;
        $this->isLeverbaar = $isLeverbaar;
    }
    public function getPlaatsId(): int
    {
        return $this->plaatsId;
    }
    public function getPostcode(): string
    {
        return $this->postcode;
    }
    public function getWoonplaats(): string
    {
        return $this->woonplaats;
    }
    public function getIsLeverbaar(): int
    {
        return $this->isLeverbaar;
    }
    
}
