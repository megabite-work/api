<?php

namespace App\Action\WebFooter;

use App\Component\Paginator;
use App\Dto\WebFooter\RequestQueryDto;
use App\Repository\WebFooterRepository;

class IndexAction
{
    public function __construct(private WebFooterRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebFootersByMultiStore($dto);
    }
}
