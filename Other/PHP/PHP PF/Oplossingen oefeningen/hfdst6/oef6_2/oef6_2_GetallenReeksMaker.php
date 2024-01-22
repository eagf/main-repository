<?php

//GetallenReeksMaker.php

declare(strict_types=1);

class GetallenReeksMaker
{

    public function getReeks() : array
    {
        $tab = array();
        for ($i = 0; $i < 10; $i++) {
            array_push($tab, rand(1, 100));
        }
        sort($tab);
        return $tab;
    }

}
