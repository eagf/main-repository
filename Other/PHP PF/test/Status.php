<?php
//Status.php

declare(strict_types=1);

class Status
{
    private int $statusID;
    private string $Status;

    public function __construct(int $statusID, string $Status)
    {
        $this->statusID = $statusID;
        $this->Status = $Status;

    }

    public function getID() : int
    {
        return $this->statusID;
    }

    public function getStatus() : string
    {
        return $this->Status;
    }


}