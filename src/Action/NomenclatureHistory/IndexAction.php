<?php

namespace App\Action\NomenclatureHistory;

use App\Component\Paginator;
use App\Dto\NomenclatureHistory\RequestQueryDto;
use App\Repository\NomenclatureHistoryRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureHistoryRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $nomenclatureHistories = $this->repo->findAllNomenclatureHistoriesWithAllJoines($dto);

        return $nomenclatureHistories;
    }
}
