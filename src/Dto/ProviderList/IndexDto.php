<?php

declare(strict_types=1);

namespace App\Dto\ProviderList;

use App\Entity\ProviderList;

final readonly class IndexDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $type,
        public readonly string $value,
    ) {}

    public static function fromEntity(?ProviderList $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                type: $entity->getType(),
                value: $entity->getvalue(),
            )
            : null;
    }
}
