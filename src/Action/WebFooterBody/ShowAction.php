<?php

namespace App\Action\WebFooterBody;

use App\Component\EntityNotFoundException;
use App\Entity\WebFooterBody;
use App\Repository\WebFooterBodyRepository;

class ShowAction
{
    public function __construct(private WebFooterBodyRepository $repo)
    {
    }

    public function __invoke(int $id): WebFooterBody
    {
        return $this->repo->find($id)
            ?? throw new EntityNotFoundException('not found');
    }
}
