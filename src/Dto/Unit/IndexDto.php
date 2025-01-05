<?php

declare(strict_types=1);

namespace App\Dto\Unit;

use App\Entity\Unit;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
        public ?int $code = null,
        public ?string $icon = null,
    ) {}

    public static function fromEntity(?Unit $entity): static
    {
        return $entity
            ? new static(
                $entity->getId(),
                $entity->getName(),
                $entity->getCode(),
                $entity->getIcon(),
            )
            : null;
    }
}
