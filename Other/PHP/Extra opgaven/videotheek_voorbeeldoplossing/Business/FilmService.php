<?php

declare(strict_types=1);

namespace Business;

use Data\FilmDAO;
use Entities\Film;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/../Data/FilmDAO.php";
require_once __DIR__ . "/../Entities/Film.php";
*/


class FilmService
{
    private FilmDAO $filmDAO;
    public function __construct()
    {
        $this->filmDAO = new FilmDAO();
    }

    public function getAllFilms(): ?array
    {
        return $this->filmDAO->getAllFilms();
    }

    public function createFilm($title): ?Film
    {
        return $this->filmDAO->createFilm($title);
    }

    public function getFilmByTitle($title): ?Film
    {
        return $this->filmDAO->getFilmByTitle($title);
    }

    public function getFilmById($filmId): ?Film
    {
        return $this->filmDAO->getFilmById($filmId);
    }

    public function deleteFilm($filmId)
    {
        return $this->filmDAO->deleteFilm($filmId);
    }
	
	public function getFilmByExId($exemplaarId)
	{
		return $this->filmDAO->getFilmByExId($exemplaarId);
	}
}
