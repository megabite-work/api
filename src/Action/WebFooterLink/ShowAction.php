<?php

namespace App\Action\WebFooterLink;

use App\Component\EntityNotFoundException;
use App\Entity\WebFooterLink;
use App\Repository\WebFooterLinkRepository;

class ShowAction
{
    public function __construct(private WebFooterLinkRepository $repo)
    {
    }

    public function __invoke(int $id): WebFooterLink
    {
        return $this->repo->find($id)
            ?? throw new EntityNotFoundException('not found');
    }
}
