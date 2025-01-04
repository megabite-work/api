<?php

namespace App\Action\WebEvent;

use App\Component\EntityNotFoundException;
use App\Entity\WebEvent;
use App\Repository\WebEventRepository;

class ShowAction
{
    public function __construct(private WebEventRepository $repo)
    {
    }

    public function __invoke(int $id): WebEvent
    {
        return $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
    }
}
