<?php
//Business/GenreService.php 
declare(strict_types=1);

namespace Business;

use Data\GenreDAO;
use Data\BoekDAO;
use Entities\Boek;
use Entities\Genre;

class GenreService
{
    public function getGenresOverzicht(): array
    {
        $genreDAO = new GenreDAO();
        $lijst = $genreDAO->getAll();
        return $lijst;
    }
}