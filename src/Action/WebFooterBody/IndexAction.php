<?php

namespace App\Action\WebFooterBody;

use App\Component\Paginator;
use App\Dto\WebFooterBody\RequestQueryDto;
use App\Repository\WebFooterBodyRepository;

class IndexAction
{
    public function __construct(private WebFooterBodyRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebFooterBodyByMultiStore($dto);
    }
}
