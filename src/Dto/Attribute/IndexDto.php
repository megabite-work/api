<?php

namespace App\Dto\Attribute;

use App\Entity\AttributeEntity;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?array $name = null,
    ) {}

    public static function fromEntity(?AttributeEntity $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName()
        );
    }
}
