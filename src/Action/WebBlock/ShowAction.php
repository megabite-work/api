<?php

namespace App\Action\WebBlock;

use App\Component\EntityNotFoundException;
use App\Entity\WebBlock;
use App\Repository\WebBlockRepository;

class ShowAction
{
    public function __construct(private WebBlockRepository $repo)
    {
    }

    public function __invoke(int $id): WebBlock
    {
        return $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
    }
}
