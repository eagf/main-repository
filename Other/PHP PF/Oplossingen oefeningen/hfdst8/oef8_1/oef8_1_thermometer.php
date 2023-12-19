<?php
//thermomether.php

declare(strict_types=1);

class Thermometer
{

    private float $temperatuur = 0;

    public function verhoog(float $aantalGraden)
    {
        $this->temperatuur += $aantalGraden;
    }

    public function verlaag(float $aantalGraden)
    {
        $this->temperatuur -= $aantalGraden;
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
            $therm = new Thermometer();
            $therm->verhoog(20);
            print($therm->getTemperatuur() . "<br />");
            $therm->verlaag(5);
            print($therm->getTemperatuur() . "<br />");
            ?>
        </h1>
    </body>
</html>
