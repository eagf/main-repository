<?php

declare(strict_types=1);

namespace Business;

use Data\ExemplaarDAO;
use Entities\Exemplaar;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/../Data/ExemplaarDAO.php";
require_once __DIR__ . "/../Entities/Exemplaar.php";
*/

class ExemplaarService
{
    private ExemplaarDAO $exemplaarDAO;
    public function __construct()
    {
        $this->exemplaarDAO = new ExemplaarDAO();
    }
    public function createExemplaar(int $filmId): ?Exemplaar
    {
        return $this->exemplaarDAO->createExemplaar($filmId);
    }

    public function getExemplaarById(int $exemplaarId): ?Exemplaar
    {
        return $this->exemplaarDAO->getExemplaarById($exemplaarId);
    }

    public function setExemplaarAvailable(int $exemplaarId, bool $isAvailable)
    {
        return $this->exemplaarDAO->setExemplaarAvailable($exemplaarId, $isAvailable);
    }

    public function deleteAllExemplarenWithFilmId($filmId)
    {
        return $this->exemplaarDAO->deleteAllExemplarenWithFilmId($filmId);
    }

    public function deleteExemplaar(int $exemplaarId)
    {
        return $this->exemplaarDAO->deleteExemplaar($exemplaarId);
    }

    public function getAllExemplaren(): ?array
    {
        return $this->exemplaarDAO->getAllExemplaren();
    }

    public function getAllExemplarenByFilmId(int $filmId): ?array
    {
        return $this->exemplaarDAO->getAllExemplarenByFilmId($filmId);
    }

}
