<?php

declare(strict_types=1);

namespace Entities;

class Exemplaar
{

	private int $exemplaarId; //int(11)
	private int $filmId; //int(11)
	private bool $aanwezig; //int(11)

	public function __construct(int $exemplaarId, int $filmId, bool $aanwezig)
	{
		$this->exemplaarId = $exemplaarId;
		$this->filmId = $filmId;
		$this->aanwezig = $aanwezig;
	}

	/**
	 * @return exemplaarId - int(11)
	 */
	public function getExemplaarId(): int
	{
		return $this->exemplaarId;
	}

	/**
	 * @return filmId - int(11)
	 */
	public function getFilmId(): int
	{
		return $this->filmId;
	}

	/**
	 * @return aanwezig - int(11)
	 */
	public function getAanwezig(): bool
	{
		return $this->aanwezig;
	}

	/**
	 * @param filmId: int(11)
	 */
	public function setFilmId(int $filmId)
	{
		$this->filmId = $filmId;
	}

	/**
	 * @param aanwezig: int(11)
	 */
	public function setAanwezig(bool $aanwezig)
	{
		$this->aanwezig = $aanwezig;
	}
}
