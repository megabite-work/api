<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IsUniqueEmailAction
{
    public function __construct(
        private UserRepository $repo
    ) {
    }

    public function __invoke(string $email): bool
    {
        return $this->repo->isUniqueEmail($email);
    }
}
