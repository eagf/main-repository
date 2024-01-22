<?php
//Bericht.php

declare(strict_types=1);

class Bericht
{

    private int $id;
    private string $nickname;
    private string $boodschap;

    public function __construct(int $id, string $nickname, string $boodschap)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->boodschap = $boodschap;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }

    public function getBoodschap() : string
    {
        return $this->boodschap;
    }

}
