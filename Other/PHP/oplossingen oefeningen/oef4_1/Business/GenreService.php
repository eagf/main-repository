<?php
//Business/GenreService.php
declare(strict_types = 1);

namespace Business;

use Data\GenreDAO;



class GenreService {

    public function getGenresOverzicht() : array {
        $genreDAO = new GenreDAO();
        $lijst = $genreDAO->getAll();
        return $lijst;
    }	
    
}

