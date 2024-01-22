<?php
//transacties.php 

// LET OP! 
// Het samenbrengen van classes en uitvoer in één file is een vereenvoudiging 
// ten behoeve van het voorbeeld 
// normaal heb je aparte files en werk je volgens het MVC-model 

declare(strict_types=1);

class Spaarder
{
    public function schrijfover(float $bedrag, string $van, string $naar)
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=cursusphp;charset=utf8", "cursusgebruiker", "cursuspwd");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            $sql = "update spaarders set spaarpot = spaarpot - :bedrag where naam = :van";
            $stmt = $dbh->prepare($sql);
            $resultSet = $stmt->execute(array(':bedrag' => $bedrag, ':van' => $van));
            if (!$stmt->rowCount()) {
                throw new Exception("fout bij afhalen");
            } // $dbh = null; 

            // controle of voldoende in spaarpot
            $sql = "select spaarpot from spaarders where naam = :van";
            $stmt = $dbh->prepare($sql);
            $resultSet = $stmt->execute(array(':van' => $van));
            $check = $stmt->fetchColumn();
            if ($check < 0) {
                throw new Exception("onvoldoende in spaarpot!");
            }


            $sql = "update spaarders set spaarpot = spaarpot + :bedrag where naam = :naar";
            $stmt = $dbh->prepare($sql);

            $resultSet = $stmt->execute(array(':bedrag' => $bedrag, ':naar' => $naar));
            if (!$stmt->rowCount()) {
                throw new Exception("fout bij storten");
            }
            $dbh->commit();
            //$dbh = null;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
            $dbh->rollBack();
        }
    }
    public function getOverzicht(): ?array
    {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=cursusphp; charset=utf8", "cursusgebruiker", "cursuspwd");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $resultSet = $dbh->query("select naam, spaarpot from spaarders");
            $lijst = array();
            if ($resultSet) {
                foreach ($resultSet as $rij) {
                    $spaarder = $rij["naam"] . ": " . $rij["spaarpot"];
                    array_push($lijst, $spaarder);
                }
            }
            $dbh = null;
            return $lijst;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
            return null;
        }
    }
} ?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Databanken</title>
</head>

<body>
    <?php
    $spaarder = new Spaarder();
    $tabel = $spaarder->getOverzicht();
    ?>
    <ul>
        <?php
        if ($tabel) {
            foreach ($tabel as $rij) {
                print("<li>" . $rij . "</li>");
            }
        }
        ?>
    </ul>
    <?php
    $spaarder->schrijfover(50, "Jan", "Piet");
    $tabel = $spaarder->getOverzicht();
    ?>
    <ul>
        <?php
        if ($tabel) {
            foreach ($tabel as $rij) {
                print("<li>" . $rij . "</li>");
            }
        }
        ?>
    </ul>
</body>

</html>