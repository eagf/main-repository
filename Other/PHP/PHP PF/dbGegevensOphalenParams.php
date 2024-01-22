<?php
//dbGegevensOphalenParams.php 
declare(strict_types=1);
class PersonenLijst
{
    public function getLijst(string $familienaam, string $geslacht): array
    {
        $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd"); //positionele params 
        $sql = "select familienaam, voornaam from personen where familienaam = ? and geslacht = ? ";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array($familienaam, $geslacht));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        //benoemde params 

        //$sql = "select familienaam, voornaam from personen 
        // where familienaam = :fn and geslacht = :gesl "; 
        //$stmt = $dbh->prepare($sql); 
        //$stmt->execute(array(':fn' => $familienaam, ':gesl' => $geslacht)); 
        //$resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        $lijst = array();
        foreach ($resultSet as $rij) {
            $naam = $rij["familienaam"] . ", " . $rij["voornaam"];
            array_push($lijst, $naam);
        }
        $dbh = null;
        return $lijst;
    }
} ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Databanken introductie</title>
</head>

<body>
    <?php $pl = new PersonenLijst();
    $tab = $pl->getLijst('Peeters', 'M'); 
    //$tab = $pl->getLijst('Peeters','V'); 
    ?>
    <ul>
        <?php foreach ($tab as $naam) {
            print("<li>" . $naam . "</li>");
        } ?>
    </ul>
</body>

</html>