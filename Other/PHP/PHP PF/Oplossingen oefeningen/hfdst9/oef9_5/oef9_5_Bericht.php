<?php
//Bericht.php

declare(strict_types=1);

class Bericht
{

	public function __construct(int $id, string $auteur, string $boodschap, string $datum)
	{
		$this->id = $id;
		$this->auteur = $auteur;
		$this->boodschap = $boodschap;
		$this->datum = $datum;
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function getAuteur() : string
	{
		return $this->auteur;
	}

	public function getBoodschap() : string
	{
		return $this->boodschap;
	}

	public function getDatum() : string
	{
		return $this->datum;
	}
}
