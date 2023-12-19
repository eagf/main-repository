<?php
//Klant.php

declare(strict_types=1);

class Klant
{
    private int $klantID;
    private string $voornaam;
	private string $achternaam;
	private string $email;

    public function __construct(int $klantID, string $voornaam, string $achternaam, string $email)
    {
        $this->klantID = $klantID;
        $this->voornaam = $voornaam;
		$this->achternaam = $achternaam;
		$this->email = $email;
    }

    public function getID() : int
    {
        return $this->klantID;
    }

    public function getVoornaam() : string
    {
        return $this->voornaam;
    }
	
    public function getAchternaam() : string
    {
        return $this->achternaam;
    }	
	
    public function getEmail() : string
    {
        return $this->email;
    }	

}