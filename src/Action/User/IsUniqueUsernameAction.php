<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IsUniqueUsernameAction
{
    public function __construct(
        private UserRepository $repo
    ) {
    }

    public function __invoke(string $username): bool
    {
        return $this->repo->isUniqueUsername($username);
    }
}
