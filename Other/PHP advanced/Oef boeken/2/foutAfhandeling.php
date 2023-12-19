<?php
//foutAfhandeling.php 

class NegatieveStortingException extends Exception
{
}

class RekeningVolException extends Exception
{
}

class BedragTeGrootException extends Exception
{
}

class Rekening
{
    private float $saldo;
    public function __construct()
    {
        $this->saldo = 0;
    }
    public function storten(float $bedrag)
    {
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
    public function getSaldo(): float
    {

        return $this->saldo;
    }
} ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Fouten afhandelen</title>
</head>

<body> <?php $rek = new Rekening();
        try {
            print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
            $rek->storten(200);
            $rek->storten(600);
            $rek->storten(300);
            print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
        } catch (NegatieveStortingException $ex) {
            print("<p>Een negatief bedrag storten is niet mogelijk!</p>");
            print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
        } catch (RekeningVolException $ex) {
            print("<p>Dit bedrag kan niet gestort worden, de limiet van de rekening is 1000 &euro;!</p>");
            print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
        } catch (BedragTeGrootException $ex) {
            print("<p>Er kan geen bedrag groter dan &euro;500 gestort worden in één keer.</p>");
            print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
        }
        ?> </body>

</html>