<?php

declare(strict_types=1);

namespace Entities;

class FilmItem
{

    private Film $film; //int(11)
    private array $exemplaren; //varchar(255)

    public function __construct(Film $film, array $exemplaren)
    {
        $this->film = $film;
        $this->exemplaren = $exemplaren;
    }

    /**
     * @return filmId - int(11)
     */
    public function getFilm(): Film
    {
        return $this->film;
    }

    /**
     * @return title - varchar(255)
     */
    public function getExemplaren(): array
    {
        return $this->exemplaren;
    }

    public function setExemplaren(array $exemplaren)
    {
        $this->exemplaren = $exemplaren;
    }

    public function getExemplarenAanwezigCount(): int
    {
        $count = 0;
        foreach ($this->exemplaren as $exemplaar) {
            if ($exemplaar->getAanwezig()) {
                $count++;
            }
        }
        return $count;
    }
}
