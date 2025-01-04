<?php

namespace App\Action\User;

use App\Entity\Role;

class ShowRoleAction
{
    public function __invoke(): array
    {
        return array_slice(Role::getRoles(), 2);
    }
}
