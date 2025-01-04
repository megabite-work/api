<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Entity\User;

final readonly class IndexDto
{
    public function __construct(
        public int $id,
        public ?string $userName,
    ) {}

    public static function fromEntity(?User $entity): static
    {
        return new static(
            id: $entity->getId(),
            userName: $entity->getUserName()
        );
    }
}
