<?php

namespace App\Action\User;

use App\Entity\User;
use App\Repository\UserRepository;

class ShowAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(int $id): User
    {
        $user = $this->repo->getUserWithAddressAndPhonesByUserId($id);

        return $user;
    }
}
