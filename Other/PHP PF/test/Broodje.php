<?php
//Broodje.php

declare(strict_types=1);

class Broodje
{
    private int $ID;
    private string $Naam;
	private string $Omschrijving;
	private float $Prijs;

    public function __construct(int $ID, string $Naam, string $Omschrijving, float $Prijs)
    {
        $this->ID = $ID;
        $this->Naam = $Naam;
		$this->Omschrijving = $Omschrijving;
		$this->Prijs = $Prijs;
    }

    public function getID() : int
    {
        return $this->ID;
    }

    public function getNaam() : string
    {
        return $this->Naam;
    }
	
    public function getOmschrijving() : string
    {
        return $this->Omschrijving;
    }	
	
    public function getPrijs() : float
    {
        return $this->Prijs;
    }	

}