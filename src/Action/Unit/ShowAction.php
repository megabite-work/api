<?php

namespace App\Action\Unit;

use App\Component\EntityNotFoundException;
use App\Entity\Unit;
use App\Repository\UnitRepository;

class ShowAction
{
    public function __construct(private UnitRepository $repo)
    {
    }

    public function __invoke(int $id): Unit
    {
        $unit = $this->repo->findUnitById($id);

        if (null === $unit) {
            throw new EntityNotFoundException('not found');
        }

        return $unit;
    }
}
