<?php

namespace App\Action\StoreNomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\Nomenclature;
use App\Repository\NomenclatureRepository;

class ShowAction
{
    public function __construct(private NomenclatureRepository $repo)
    {
    }

    public function __invoke(int $storeId, int $nomenclatureId): Nomenclature
    {
        $nomenclature = $this->repo->findNomenclatureByIdWithStore($storeId, $nomenclatureId);

        if (null == $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        return $nomenclature;
    }
}
