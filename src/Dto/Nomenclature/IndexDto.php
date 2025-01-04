<?php

declare(strict_types=1);

namespace App\Dto\Nomenclature;

use App\Entity\Nomenclature;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?int $barcode,
    ) {}

    public static function fromEntity(Nomenclature $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            barcode: $entity->getBarcode(),
        );
    }
}
