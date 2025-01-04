<?php

namespace App\Action\Nomenclature;

use App\Component\Paginator;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Repository\NomenclatureRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $dto->getCategoryId() ? $this->repo->findAllNomenclaturesByCategory($dto) : $this->repo->findAllNomenclatures($dto);
    }
}
