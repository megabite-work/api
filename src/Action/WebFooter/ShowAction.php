<?php

namespace App\Action\WebFooter;

use App\Component\EntityNotFoundException;
use App\Entity\WebFooter;
use App\Repository\WebFooterRepository;

class ShowAction
{
    public function __construct(private WebFooterRepository $repo)
    {
    }

    public function __invoke(int $id): WebFooter
    {
        return $this->repo->find($id)
            ?? throw new EntityNotFoundException('not found');
    }
}
