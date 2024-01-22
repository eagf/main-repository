<?php
//foutAfhandeling.php

declare(strict_types=1);

class NegatieveStortingException extends Exception {    
}

class RekeningVolException extends Exception {    
}

class BedragTeGrootException extends Exception {
}

class Rekening {

    private $saldo;

    public function __construct() {
        $this->saldo = 0;
    }

    public function storten(float $bedrag) {
        if ($bedrag < 0) {
            throw new NegatieveStortingException();
        }
        if ($this->saldo + $bedrag > 1000) {
            throw new RekeningVolException();
        }
        if ($bedrag > 500) {
            throw new BedragTeGrootException();
        }

        $this->saldo += $bedrag;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fouten afhandelen</title>
    </head>
    <body>

        <?php
        $rek = new Rekening();
        try {
            print("<p>Saldo: &euro; " . $rek->getSaldo() . "</p>");
            
            $rek->storten(200);
 //          $rek->storten(-200);          
            $rek->storten(600);
 //           $rek->storten(900); 

            
            print("<p>Saldo: &euro; " . $rek->getSaldo() . "</p>");

        } catch (NegatieveStortingException $ex) {
            print("<p>Een negatief bedrag storten is niet mogelijk!</p>");
            print("<p>Saldo: &euro; " . $rek->getSaldo() . "</p>");
        } catch (RekeningVolException $ex) {
            print("<p>Dit bedrag kan niet gestort worden: de limiet van de rekening is &euro; 1000!</p>");
            print("<p>Saldo: &euro; " . $rek->getSaldo() . "</p>");
        } catch (BedragTeGrootException $ex) {
            print("<p>Dit bedrag kan niet gestort worden: het te storten bedrag kan maximaal &euro; 500 bedragen!</p>");
            print("<p>Saldo: &euro; " . $rek->getSaldo() . "</p>");
        }
        ?>

    </body>
</html>
