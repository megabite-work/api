<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\RequestDto;
use App\Repository\NomenclatureRepository;

class IsUniqueNameByMultiStoreAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {
    }

    public function __invoke(RequestDto $dto): bool
    {
        return $this->repo->IsUniqueNameByMultiStore($dto);
    }
}
