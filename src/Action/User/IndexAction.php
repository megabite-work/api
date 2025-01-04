<?php

namespace App\Action\User;

use App\Component\Paginator;
use App\Dto\User\RequestQueryDto;
use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $users = $this->repo->findUsersWithPagination($dto);

        return $users;
    }
}
