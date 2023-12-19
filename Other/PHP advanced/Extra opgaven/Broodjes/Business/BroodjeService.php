<?php

declare(strict_types=1);

namespace Business;

use Data\BroodjeDAO;
use Entities\Broodje;

class BroodjeService
{

    private BroodjeDAO $broodjeDAO;
    public function __construct()
    {
        $this->broodjeDAO = new BroodjeDAO();
    }

    public function getAll(): ?array
    {
        return $this->broodjeDAO->getAll();
    }
    public function getBroodjeByBroodjeId($broodjeid): ?Broodje
    {
        return $this->broodjeDAO->getBroodjeByBroodjeId($broodjeid);
    }

}