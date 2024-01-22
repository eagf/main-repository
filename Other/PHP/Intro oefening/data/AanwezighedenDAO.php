<?php 
//data/AanwezighedenDAO.php 

declare(strict_types=1);
class AanwezighedenDAO
{
    public function createAanwezigheden(array $aanwezigheden)
    { 
        
        // we schrijven de aanwezigheden hier even weg naar een sessie-variabele 
        // normaal komt hier de code om weg te schrijven naar de database 
        // dit doen we in een volgende oefening

        session_start();
        $_SESSION["aanwezigheden"] = serialize($aanwezigheden);
    }
}
