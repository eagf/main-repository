<?php

declare(strict_types=1);

namespace Entities;

class Film
{

	private int $filmId; //int(11)
	private string $title; //varchar(255)

	public function __construct(int $filmId, string $title)
	{
		$this->filmId = $filmId;
		$this->title = $title;
	}

	/**
	 * @return filmId - int(11)
	 */
	public function getFilmId(): int
	{
		return $this->filmId;
	}

	/**
	 * @return title - varchar(255)
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param title: varchar(255)
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
	}
}
