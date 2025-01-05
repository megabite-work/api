<?php

declare(strict_types=1);

namespace App\Dto\StoreNomenclature;

use App\Dto\Nomenclature\IndexDto as NomenclatureDto;
use App\Dto\Store\IndexDto as StoreDto;
use App\Entity\StoreNomenclature;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?NomenclatureDto $nomenclature = null,
        public ?StoreDto $store = null,
        public ?float $qty = 0,
    ) {}

    public static function fromEntity(?StoreNomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                nomenclature: NomenclatureDto::fromEntity($entity->getNomenclature()),
                store: StoreDto::fromEntity($entity->getStore()),
                qty: $entity->getQty(),
            )
            : null;
    }

    public static function fromNomenclature(?StoreNomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                store: StoreDto::fromEntity($entity->getStore()),
                qty: $entity->getQty(),
            )
            : null;
    }

    public static function fromStore(?StoreNomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                nomenclature: NomenclatureDto::fromEntity($entity->getNomenclature()),
                qty: $entity->getQty(),
            )
            : null;
    }

    public static function fromNomenclatureArray(?array $entities = []): array
    {
        return array_map([static::class, 'fromNomenclature'], $entities);
    }

    
}
