<?php
//interfaces.php 
declare(strict_types=1);
interface Omvang
{
    public function getGrootte(): float;
}
class Persoon implements Omvang
{
    private float $lengte;
    public function __construct(float $lengte)
    {
        $this->lengte = $lengte;
    }
    public function getGrootte(): float
    {
        return $this->lengte;
    }
}
class Oppervlakte implements Omvang
{
    private float $breedte;
    private float $lengte;
    public function __construct(float $breedte, float $lengte)
    {
        $this->breedte = $breedte;
        $this->lengte = $lengte;
    }
    public function getGrootte(): float
    {
        return $this->lengte * $this->breedte;
    }
} ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>
    <title>Interfaces</title>
</head>

<body>
    <h1>
        <?php $p = new Persoon(190);
        print($p->getGrootte() . "<br>");
        $o = new Oppervlakte(20, 30);
        print($o->getGrootte()); ?>
    </h1>
</body>

</html>