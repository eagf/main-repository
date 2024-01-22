<?php

declare(strict_types=1);

namespace Business;

use Data\BelegDAO;
use Entities\Beleg;

class BelegService
{

    private BelegDAO $belegDAO;
    public function __construct()
    {
        $this->belegDAO = new BelegDAO();
    }

    public function getAll(): array
    {
        return $this->belegDAO->getAll();
    }

}