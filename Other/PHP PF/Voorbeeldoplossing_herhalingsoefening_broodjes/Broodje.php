<?php
//Broodje.php

declare(strict_types=1);

class Broodje
{
    private int $broodid;
    private string $naam;
	private string $omschrijving;
	private float $prijs;

    public function __construct(int $broodid, string $naam, string $omschrijving, float $prijs)
    {
        $this->broodid = $broodid;
        $this->naam = $naam;
		$this->omschrijving = $omschrijving;
		$this->prijs = $prijs;
    }

    public function getId() : int
    {
        return $this->broodid;
    }

    public function getNaam() : string
    {
        return $this->naam;
    }
	
    public function getOmschrijving() : string
    {
        return $this->omschrijving;
    }	
	
    public function getPrijs() : float
    {
        return $this->prijs;
    }	

}