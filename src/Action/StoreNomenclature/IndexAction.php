<?php

namespace App\Action\StoreNomenclature;

use App\Component\Paginator;
use App\Dto\StoreNomenclature\RequestQueryDto;
use App\Repository\NomenclatureRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {
    }

    public function __invoke(int $storeId, RequestQueryDto $dto): Paginator
    {
        $nomenclatures = $this->repo->findAllNomenclaturesWithStoreAndCategory($storeId, $dto);

        return $nomenclatures;
    }
}
