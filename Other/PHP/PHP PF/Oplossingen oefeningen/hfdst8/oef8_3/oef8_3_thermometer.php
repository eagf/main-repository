<?php
//thermomether.php

declare(strict_types=1);

class Thermometer
{

    private $temperatuur;

    function __construct(float $temperatuur)
    {
        $this->temperatuur = $temperatuur;
    }

    public function verhoog(float $aantalGraden)
    {
        if (($this->temperatuur + $aantalGraden) <= 100) {
            $this->temperatuur += $aantalGraden;
        }
    }

    public function verlaag(float $aantalGraden)
    {
        if (($this->temperatuur - $aantalGraden) >= -50) {
            $this->temperatuur -= $aantalGraden;
        }
    }

    public function getTemperatuur() : float
    {
        return $this->temperatuur;
    }

}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Thermometer</title>
    </head>
    <body>
        <h1>
            <?php
            $therm = new Thermometer(25);
            print($therm->getTemperatuur() . "<br />");
            $therm->verhoog(20);
            print($therm->getTemperatuur() . "<br />");
            $therm->verhoog(55);
            print($therm->getTemperatuur() . "<br />");
            $therm->verhoog(10);
            print($therm->getTemperatuur() . "<br />");
            $therm->verlaag(50);
            print($therm->getTemperatuur() . "<br />");
            $therm->verlaag(100);
            print($therm->getTemperatuur() . "<br />");
            $therm->verlaag(10);
            print($therm->getTemperatuur() . "<br />");
            ?>
        </h1>
    </body>
</html>
