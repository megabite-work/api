<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\RequestDto;
use App\Repository\NomenclatureRepository;

class IsUniqueBarcodeByMultiStoreAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): bool
    {
        return $this->repo->IsUniqueBarcodeByMultiStore($dto);
    }
}
