<?php

//GetallenKiezer.php

declare(strict_types=1);

class GetallenKiezer
{

    public function getGetallenReeks() : array
    {
        $tab = array();
        while (count($tab) < 6) {
            $getal = rand(1, 42);
            if (!in_array($getal, $tab)) {
                array_push($tab, $getal);
            }
        }
        return $tab;
    }

}
