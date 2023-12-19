<?php
//Punt.php

declare(strict_types=1);

class Punt
{
    private Module $moduleID;
    private Persoon $persoonID;
    private int $punt;

    public function __construct(Module $moduleID, Persoon $persoonID, int $punt)
    {
        $this->moduleID = $moduleID;
        $this->persoonID = $persoonID;
        $this->punt = $punt;
    }

    public function getModule(): Module
    {
        return $this->moduleID;
    }

    public function getPersoon(): Persoon
    {
        return $this->persoonID;
    }

    public function getPunt(): int
    {
        return $this->punt;
    }

}