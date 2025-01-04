<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\WebNomenclature;
use App\Repository\WebNomenclatureRepository;

class ShowAction
{
    public function __construct(private WebNomenclatureRepository $repo)
    {
    }

    public function __invoke(int $id): WebNomenclature
    {
        $webNomeclature = $this->repo->findWebNomenclatureByIdWithCategoryUnitStoreNomenclature($id);

        if (null == $webNomeclature) {
            throw new EntityNotFoundException('not found');
        }

        return $webNomeclature;
    }
}
