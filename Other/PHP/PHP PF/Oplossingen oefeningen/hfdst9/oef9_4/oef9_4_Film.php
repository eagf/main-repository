<?php
//Film.php

declare(strict_types=1);

class Film
{

    private int $id;
    private string $titel;
    private int $duurtijd;

    public function __construct(int $id, string $titel, int $duurtijd)
    {
        $this->id = $id;
        $this->titel = $titel;
        $this->duurtijd = $duurtijd;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTitel() : string
    {
        return $this->titel;
    }

    public function getDuurtijd() : int
    {
        return $this->duurtijd;
    }

}
