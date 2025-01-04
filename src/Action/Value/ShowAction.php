<?php

namespace App\Action\Value;

use App\Component\EntityNotFoundException;
use App\Entity\ValueEntity;
use App\Repository\ValueEntityRepository;

class ShowAction
{
    public function __construct(private ValueEntityRepository $repo)
    {
    }

    public function __invoke(int $id): ValueEntity
    {
        $entity = $this->repo->find($id);

        if (null == $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
