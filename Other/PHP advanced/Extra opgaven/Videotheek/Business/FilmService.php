<?php
//Business/FilmService.php
declare(strict_types=1);

namespace Business;

use Data\FilmDAO;
use Entities\Exemplaar;
use Entities\Film;

class FilmService
{
    private FilmDAO $filmDAO;
    public function __construct()
    {
        $this->filmDAO = new FilmDAO();
    }

    public function getFilmsOverzicht(): array
    {
        return $this->filmDAO->getAllFilms();
    }

    public function getExemplarenOverzicht(): array
    {
        return $this->filmDAO->getAllExemplaren();
    }

    public function getExemplarenByFilmId(int $filmId): array
    {
        return $this->filmDAO->getExemplarenByFilmId($filmId);
    }

    public function getTotalExemplarenByFilmId(int $filmId): int
    {
        return $this->filmDAO->getTotalExemplarenByFilmId($filmId);
    }

    public function getAanwezigById(int $id): int
    {
        return $this->filmDAO->getAanwezigById($id);
    }

    public function getExemplaarById(int $id): ?Exemplaar
    {
        return $this->filmDAO->getExemplaarById($id);
    }

    public function createFilm($titel)
    {
        $this->filmDAO->createFilm($titel);
    }

    public function createExemplaar(int $filmId, int $id)
    {
        $this->filmDAO->createExemplaar($filmId, $id);
    }

    public function deleteFilm(int $id)
    {
        $this->filmDAO->deleteFilm($id);
    }

    public function deleteExemplaar(int $id)
    {
        $this->filmDAO->deleteExemplaar($id);
    }

    public function updateAanwezigheid(int $id, int $aanwezig)
    {
        $this->filmDAO->updateAanwezigheid($id, $aanwezig);
    }
}