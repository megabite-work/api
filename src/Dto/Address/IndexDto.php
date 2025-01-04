<?php

declare(strict_types=1);

namespace App\Dto\Address;

use App\Entity\Address;

class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $region = null,
        public ?string $district = null,
        public ?string $street = null,
        public ?string $house = null,
        public ?string $latitude = null,
        public ?string $longitude = null,
    ) {}

    public static function fromEntity(?Address $entity): static
    {
        return new static(
            id: $entity->getId(),
            region: $entity->getRegion(),
            district: $entity->getDistrict(),
            street: $entity->getStreet(),
            house: $entity->getHouse(),
            latitude: $entity->getLatitude(),
            longitude: $entity->getLongitude(),
        );
    }
}
