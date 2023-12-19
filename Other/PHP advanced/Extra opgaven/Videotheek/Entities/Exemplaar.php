<?php
//Entities/Exemplaar.php 
declare(strict_types=1);

namespace Entities;

//use Entities\Film;

class Exemplaar
{
    private int $id;
    private int $filmId;
    private int $aanwezig;
    public function __construct(int $id, int $filmId, int $aanwezig)
    {
        $this->id = $id;
        $this->filmId = $filmId;
        $this->aanwezig = $aanwezig;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getFilmId(): int
    {
        return $this->filmId;
    }
    public function getAanwezig(): int
    {
        return $this->aanwezig;
    }
}