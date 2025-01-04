<?php

namespace App\Dto\Permission;

use Symfony\Component\Validator\Constraints as Assert;

final class AssignDto
{
    public function __construct(
        #[Assert\NotBlank]
        private ?int $userId,
        #[Assert\NotBlank]
        private ?int $permissionId,
    ) {
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getPermissionId(): ?int
    {
        return $this->permissionId;
    }
}
