<?php

namespace App\Action\Unit;

use App\Component\Paginator;
use App\Dto\Unit\RequestQueryDto;
use App\Repository\UnitRepository;

class IndexAction
{
    public function __construct(
        private UnitRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $units = $this->repo->findAllUnits($dto);

        return $units;
    }
}
