<?php
//Entities/Bestelling.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class Bestelling
{
    private int $bestelid;
    private int $klantid;
    private string $datumtijd;

    public function __construct(
        int $bestelid,
        int $klantid,
        string $datumtijd
    ) {
        $this->bestelid = $bestelid;
        $this->klantid = $klantid;
        $this->datumtijd = $datumtijd;
    }
    public function getBestelid(): int
    {
        return $this->bestelid;
    }
    public function getKlantid(): int
    {
        return $this->klantid;
    }
    public function getDatumtijd(): string
    {
        return $this->datumtijd;
    }
    public function setKlantid(int $klantid)
    {
        $this->klantid = $klantid;
    }
    public function setDatumtijd(string $datumtijd)
    {
        $this->datumtijd = $datumtijd;
    }

}