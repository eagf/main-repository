<?php
//Business/BoekService.php
declare(strict_types=1);

namespace Business;

use Data\BoekDAO;
use Data\GenreDAO;
use Entities\Boek;
use Entities\Genre;

class BoekService
{
    public function getBoekenOverzicht(): array
    {
        $boekDAO = new BoekDAO();
        $lijst = $boekDAO->getAll();
        return $lijst;
    }
    public function voegNieuwBoekToe(string $titel, int $genreId)
    {
        $boekDAO = new BoekDAO();
        $boekDAO->create($titel, $genreId);
    }
    public function verwijderBoek(int $id)
    {
        $boekDAO = new BoekDAO();
        $boekDAO->delete($id);
    }
    public function haalBoekOp(int $id): Boek
    {
        $boekDAO = new BoekDAO();

        $boek = $boekDAO->getById($id);
        return $boek;
    }
    public function updateBoek(int $id, string $titel, int $genreId)
    {
        $genreDAO = new GenreDAO();
        $boekDAO = new BoekDAO();
        $genre = $genreDAO->getById($genreId);
        $boek = $boekDAO->getById($id);
        $boek->setTitel($titel);
        $boek->setGenre($genre);
        $boekDAO->update($boek);
    }
}