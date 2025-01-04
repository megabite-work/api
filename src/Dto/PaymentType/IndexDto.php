<?php

declare(strict_types=1);

namespace App\Dto\PaymentType;

use App\Entity\PaymentType;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?array $name = null,
        public ?string $type = null,
    ) {}

    public static function fromEntity(?PaymentType $entity): static
    {
        return new static(
            $entity->getId(),
            $entity->getName(),
            $entity->getType(),
        );
    }
}
