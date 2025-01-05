<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\IndexDto;
use App\Repository\NomenclatureRepository;

class ShowAction
{
    public function __construct(
        private NomenclatureRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromShowAction($this->repo->findNomenclatureById($id));
    }
}
