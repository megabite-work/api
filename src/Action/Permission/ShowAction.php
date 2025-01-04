<?php

namespace App\Action\Permission;

use App\Component\EntityNotFoundException;
use App\Entity\Permission;
use App\Repository\PermissionRepository;

class ShowAction
{
    public function __construct(private PermissionRepository $repo)
    {
    }

    public function __invoke(int $id): Permission
    {
        return $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
    }
}
