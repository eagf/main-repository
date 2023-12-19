<?php
//Entities/BelegDetail.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class BelegDetail
{
    private int $besteldetailid;
    private int $belegid;

    public function __construct(
        int $besteldetailid,
        int $belegid,
    ) {
        $this->besteldetailid = $besteldetailid;
        $this->belegid = $belegid;
    }
    public function getBesteldetailid(): int
    {
        return $this->besteldetailid;
    }
    public function getBelegid(): int
    {
        return $this->belegid;
    }
    public function setBesteldetailid(int $besteldetailid)
    {
        $this->besteldetailid = $besteldetailid;
    }
    public function setBelegid(int $belegid)
    {
        $this->belegid = $belegid;
    }


}