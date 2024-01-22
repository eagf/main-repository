<?php
//business/Klasbeheer.php 

declare(strict_types=1);
require_once("data/CursistenDAO.php");
require_once("data/AanwezighedenDAO.php");
require_once("entities/Aanwezigheid.php");

class Klasbeheer
{
    public function aanwezigheidslijst(): array
    {
        $cDAO = new CursistenDAO();
        $cursisten = $cDAO->getAll();
        $aanwezigheden = [];
        foreach ($cursisten as $cursist) {

            $aanwezigheid = new Aanwezigheid($cursist, new DateTime('now'), false);
            array_push($aanwezigheden, $aanwezigheid);
        }
        return $aanwezigheden;
    }
    public function registreerAanwezigheden(array $aanwezigheden)
    {
        $aDAO = new AanwezighedenDAO();
        $aDAO->createAanwezigheden($aanwezigheden);
    }
}
