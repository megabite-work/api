<?php

namespace App\Action\WebNomenclature;

use App\Component\Paginator;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Repository\WebNomenclatureRepository;

class IndexAction
{
    public function __construct(
        private WebNomenclatureRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebNomenclaturesByMultiStore($dto);
    }
}
