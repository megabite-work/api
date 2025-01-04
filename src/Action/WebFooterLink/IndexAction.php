<?php

namespace App\Action\WebFooterLink;

use App\Component\Paginator;
use App\Dto\WebFooterLink\RequestQueryDto;
use App\Repository\WebFooterLinkRepository;

class IndexAction
{
    public function __construct(private WebFooterLinkRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebFooterLinksByWebFooterBody($dto);
    }
}
