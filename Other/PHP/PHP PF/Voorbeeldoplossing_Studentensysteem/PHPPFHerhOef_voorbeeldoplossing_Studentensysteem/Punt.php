<?php
//Punt.php

declare(strict_types=1);

class Punt
{
    private int $puntid;
    private Module $module;
    private Persoon $persoon;    
    private int $punt;

    public function __construct(int $puntid, Module $module, Persoon $persoon, int $punt)
    {
        $this->puntid = $puntid;
        $this->module = $module;
        $this->persoon = $persoon;        
        $this->punt = $punt;
    }

    public function getId() : int
    {
        return $this->puntid;
    }    
    
    public function getModule() : Module
    {
        return $this->module;
    }
    
    public function getPersoon() : Persoon
    {
        return $this->persoon;
    }
    
    public function getPunt() : int
    {
        return $this->punt;
    }

}