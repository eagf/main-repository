<?php
//entities/Aanwezigheid.php 

declare(strict_types=1);
require_once("entities/Cursist.php");
class Aanwezigheid
{
    private Cursist $cursist;
    private DateTime $datum;
    private bool $aanwezig;

    public function __construct(Cursist $cursist, DateTime $datum, bool $aanwezig)
    {
        $this->cursist = $cursist;
        $this->datum = $datum;
        $this->aanwezig = $aanwezig;
    }

    public function getCursist(): Cursist
    {
        return $this->cursist;
    }

    public function getDatum(): DateTime
    {
        return $this->datum;
    }

    public function getAanwezig(): bool
    {
        return $this->aanwezig;
    }

    public function setCursist(Cursist $cursist)
    {
        $this->cursist = $cursist;
    }

    public function setDatum(DateTime $datum)
    {
        $this->datum = $datum;
    }
    
    public function setAanwezig(bool $aanwezig)
    {
        $this->datum = $aanwezig;
    }
}
