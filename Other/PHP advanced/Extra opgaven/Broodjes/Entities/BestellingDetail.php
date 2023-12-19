<?php
//Entities/BestellingDetail.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Exemplaar;

class BestellingDetail
{
    private int $besteldetailid;
    private int $bestelid;
    private int $broodjeid;

    public function __construct(
        int $besteldetailid,
        int $bestelid,
        int $broodjeid
    ) {
        $this->besteldetailid = $besteldetailid;
        $this->bestelid = $bestelid;
        $this->broodjeid = $broodjeid;
    }
    public function getBesteldetailid(): int
    {
        return $this->besteldetailid;
    }
    public function getBestelid(): int
    {
        return $this->bestelid;
    }
    public function getBroodjeid(): int
    {
        return $this->broodjeid;
    }
    public function setBestelid(int $bestelid)
    {
        $this->bestelid = $bestelid;
    }
    public function setBroodjeid(int $broodjeid)
    {
        $this->broodjeid = $broodjeid;
    }

}