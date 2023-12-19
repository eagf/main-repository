<?php
//Bestelling.php

declare(strict_types=1);

class Bestelling
{
	private int $bestelid;
	private string $datumtijd;
	private Gebruiker $gebruiker;
    private Broodje $broodje;

    public function __construct(int $bestelid, string $datumtijd, Gebruiker $gebruiker, Broodje $broodje)
    {
        $this->bestelid = $bestelid;
        $this->datumtijd = $datumtijd;
		$this->gebruiker = $gebruiker;
		$this->broodje = $broodje;
    }

    public function getId() : int
    {
        return $this->bestelid;
    }

    public function getDatumtijd() : string
    {
        return $this->datumtijd;
    }
	
    public function getGebruiker() : Gebruiker
    {
        return $this->gebruiker;
    }
	
    public function getBroodje() : Broodje
    {
        return $this->broodje;
    }	

}