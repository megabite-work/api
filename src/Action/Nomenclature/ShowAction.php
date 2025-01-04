<?php

namespace App\Action\Nomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\Nomenclature;
use App\Repository\NomenclatureRepository;

class ShowAction
{
    public function __construct(private NomenclatureRepository $repo)
    {
    }

    public function __invoke(int $id): Nomenclature
    {
        $nomenclature = $this->repo->findNomenclatureById($id);

        if (null == $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        return $nomenclature;
    }
}
