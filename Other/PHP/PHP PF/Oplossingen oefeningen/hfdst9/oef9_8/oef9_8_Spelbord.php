<?php
//Spelbord.php

declare(strict_types=1);

class Spelbord
{

    private $bord;

    public function __construct(int $kolommen, int $rijen)
    {
        $this->bord = array();
        for ($k = 0; $k < $kolommen; $k++) {
            $this->bord[$k] = array();
            for ($r = 0; $r < $rijen; $r++) {
                $this->bord[$k][$r] = 0;
            }
        }
        $this->genereerStartOpstelling();
    }

    private function genereerStartOpstelling()
    {
        for ($i = 0; $i < 1; $i++) {
            $kolom = rand(0, $this->getAantalKolommen() - 1);
            $rij = rand(0, $this->getAantalRijen() - 1);
            $this->schakelOm($kolom, $rij);
        }
    }

    public function getAantalKolommen() : int
    {
        return count($this->bord);
    }

    public function getAantalRijen() : int
    {
        return count($this->bord[0]);
    }

    public function schakelOm(int $kolom, int $rij) : bool
    {
        $this->schakelSpecifiek($kolom, $rij);
        if ($kolom > 0) {
            $this->schakelSpecifiek($kolom - 1, $rij);
        }
        if ($kolom < $this->getAantalKolommen() - 1) {
            $this->schakelSpecifiek($kolom + 1, $rij);
        }
        if ($rij > 0) {
            $this->schakelSpecifiek($kolom, $rij - 1);
        }
        if ($rij < $this->getAantalRijen() - 1) {
            $this->schakelSpecifiek($kolom, $rij + 1);
        }
        return $this->alleLichtenZijnUit();
    }

    private function schakelSpecifiek(int $kolom, int $rij)
    {
        if ($this->bord[$kolom][$rij] == 0) {
            $this->bord[$kolom][$rij] = 1;
        } else {
            $this->bord[$kolom][$rij] = 0;
        }
    }

    private function alleLichtenZijnUit() : bool
    {
        $lichtGevonden = false;
        $kolom = 0;
        while ($lichtGevonden == false && $kolom < $this->getAantalKolommen()) {
            $rij = 0;
            while ($lichtGevonden == false && $rij < $this->getAantalRijen()) {
                if ($this->getStatus($kolom, $rij) == 1) {
                    $lichtGevonden = true;
                }
                $rij++;
            }
            $kolom++;
        }
        return !$lichtGevonden;
    }

    public function getStatus($kolom, $rij) : int
    {
        return $this->bord[$kolom][$rij];
    }

}
