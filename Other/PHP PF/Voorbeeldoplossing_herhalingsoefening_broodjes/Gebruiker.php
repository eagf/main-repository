<?php
//Gebruiker.php

declare(strict_types=1);

class Gebruiker
{
    private int $gebrid;
    private string $naam;
	private string $email;
	private string $wachtwoord;
	private int $geblokkeerd;

    public function __construct(int $gebrid, string $naam, string $email, string $wachtwoord, int $geblokkeerd)
    {
        $this->gebrid = $gebrid;
        $this->naam = $naam;
		$this->email = $email;
		$this->wachtwoord = $wachtwoord;
		$this->geblokkeerd = $geblokkeerd;
    }

    public function getId() : int
    {
        return $this->gebrid;
    }

    public function getNaam() : string
    {
        return $this->naam;
    }
	
    public function getEmail() : string
    {
        return $this->email;
    }	
	
    public function getWachtwoord() : string
    {
        return $this->wachtwoord;
    }	
	
    public function getGeblokkeerd() : int
    {
        return $this->geblokkeerd;
    }	

}