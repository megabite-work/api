<?php

namespace App\Action\Permission;

use App\Component\Paginator;
use App\Dto\Permission\RequestQueryDto;
use App\Repository\PermissionRepository;

class IndexAction
{
    public function __construct(
        private PermissionRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllPermissions($dto);
    }
}
