<?php

declare(strict_types=1);

namespace App\Dto\Region;

use App\Entity\Region;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
    ) {}

    public static function fromEntity(?Region $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName()
        );
    }
}
