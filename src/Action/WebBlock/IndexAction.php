<?php

namespace App\Action\WebBlock;

use App\Component\Paginator;
use App\Dto\WebBlock\RequestQueryDto;
use App\Repository\WebBlockRepository;

class IndexAction
{
    public function __construct(private WebBlockRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebBloksByMultiStore($dto);
    }
}
