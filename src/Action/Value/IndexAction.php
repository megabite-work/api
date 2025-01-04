<?php

namespace App\Action\Value;

use App\Component\Paginator;
use App\Dto\Value\RequestQueryDto;
use App\Repository\ValueEntityRepository;

class IndexAction
{
    public function __construct(
        private ValueEntityRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $entities = $this->repo->findAllValuesByAttribute($dto);

        return $entities;
    }
}
