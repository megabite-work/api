<?php

declare(strict_types=1);

namespace App\Dto\Phone;

use App\Entity\Phone;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $number = null,
    ) {}

    public static function fromEntity(?Phone $entity): static
    {
        return new static(
            id: $entity->getId(),
            number: $entity->getPhone()
        );
    }

    public static function fromEntityArray(array $entities = []): array
    {
        return array_map(fn(Phone $entity) => static::fromEntity($entity), $entities);
    }
}
