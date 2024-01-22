<?php
//Entities/Boek.php
declare(strict_types = 1);

namespace Entities;

use Entities\Genre;

class Boek {
    
    private $id;
    private $titel; 
    private $genre;
    
    public function __construct(int $id, string $titel, Genre $genre){
       $this->id = $id;
       $this->titel = $titel;
       $this->genre = $genre;
    }
        
    public function getId(): int {
        return $this->id;
    }
    
    public function getTitel() : string{
        return $this->titel;
    }
    public function getGenre() : Genre{
        return $this->genre;
    }
    
    public function setTitel(string $titel){
         $this->titel = $titel;
    }
    public function setGenre(Genre $genre){
         $this->genre = $genre;
    }   
}
