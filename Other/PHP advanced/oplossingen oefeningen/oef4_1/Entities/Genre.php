<?php
//Entities/Genre.php
declare(strict_types = 1);

namespace Entities;

class Genre {
    private static $idMap = array();
    
    private $id;
    private $genreNaam;
    
    private function __construct(int $id, string $genrenaam){
        $this->id = $id;
        $this->genreNaam = $genrenaam;
    }
    
    public static function create(int $id, string $genreNaam){
        if (!isset(self::$idMap[$id])) {
            self::$idMap[$id] = new Genre($id, $genreNaam);
        }
        return self::$idMap[$id];
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getGenreNaam() : string{
        return $this->genreNaam;
    }
    public function setGenreNaam(string $genreNaam){
         $this->genreNaam = $genrenaam;
    }
}

