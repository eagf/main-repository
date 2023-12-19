<?php
//foutmeldingenPDO.php 

// LET OP! 
// Het samenbrengen van classes en 
// uitvoer in één file is een vereenvoudiging 
// ten behoeve van het voorbeeld 
// normaal heb je aparte files en werk je volgens het MVC-model 

declare(strict_types=1);
class PersonenLijst
{
    public function getLijst(): ?array
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
            $resultSet = $dbh->query("select familienaam, voornaam from personen");
            $lijst = array();
            if ($resultSet) {
                foreach ($resultSet as $rij) {
                    $naam = $rij["familienaam"] . ", " . $rij["voornaam"];
                    array_push($lijst, $naam);
                }
            }
            $dbh = null;
            return $lijst;
        } catch (Exception $e) {
            // LET OP! 
            // De “echo” hier is een vereenvoudiging: 
            // normaal ga je hier een gepaste exception “throwen” 
            // niet rechtstreeks iets tonen op het scherm 
            $error = $e->getMessage();
            echo $error;
            return null;
        }
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Databanken</title>
</head>

<body>

    <?php $pl = new PersonenLijst();
    $tab = $pl->getLijst(); ?>
    <ul> <?php if ($tab) {
                foreach ($tab as $naam) {
                    print("<li>" . $naam . "</li>");
                }
            } ?> </ul>
</body>

</html>