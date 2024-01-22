<?php
//GetallenReeksMaker.php 
declare(strict_types=1);
class GetallenReeksMaker {
    public function getReeks(): array { 
        $array = array();
        
        $i = 0;
        for ($i; $i < 10; $i++) {
            $array[$i] = rand(1,100);
        }
        sort($array);
        return $array;
    }
}