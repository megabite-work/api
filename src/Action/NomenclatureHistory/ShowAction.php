<?php

namespace App\Action\NomenclatureHistory;

use App\Component\EntityNotFoundException;
use App\Entity\NomenclatureHistory;
use App\Repository\NomenclatureHistoryRepository;

class ShowAction
{
    public function __construct(private NomenclatureHistoryRepository $repo)
    {
    }

    public function __invoke(int $id): NomenclatureHistory
    {
        $nomenclatureHistory = $this->repo->findNomenclatureHistoryById($id);

        if (null == $nomenclatureHistory) {
            throw new EntityNotFoundException('not found');
        }

        return $nomenclatureHistory;
    }
}
