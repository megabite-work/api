<?php

namespace App\Dto\DeliverySettings;

use App\Dto\Region\IndexDto as RegionDto;
use App\Dto\Store\IndexDto as StoreDto;
use App\Entity\DeliverySettings;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $deliveryType = null,
        public ?float $minSum = null,
        public ?float $firstKm = null,
        public ?float $deliverySum = null,
        public ?float $nextKmSum = null,
        public ?StoreDto $store = null,
        public ?RegionDto $region = null,
    ) {}

    public static function fromEntity(?DeliverySettings $entity, bool $withRelations = false): static
    {
        if ($entity === null) {
            return new static();
        }

        if ($withRelations) {
            return new static(
                id: $entity->getId(),
                deliveryType: $entity->getDeliveryType(),
                minSum: $entity->getMinSum(),
                firstKm: $entity->getFirstKm(),
                deliverySum: $entity->getDeliverySum(),
                nextKmSum: $entity->getNextKmSum(),
                store: StoreDto::fromEntity($entity->getStore()),
                region: RegionDto::fromEntity($entity->getParent()),
            );
        }

        return new static(
            id: $entity->getId(),
            deliveryType: $entity->getDeliveryType(),
            minSum: $entity->getMinSum(),
            firstKm: $entity->getFirstKm(),
            deliverySum: $entity->getDeliverySum(),
            nextKmSum: $entity->getNextKmSum(),
        );
    }
}
