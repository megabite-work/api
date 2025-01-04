<?php

declare(strict_types=1);

namespace App\Dto\Store;

use App\Dto\Address\IndexDto as AddressDto;
use App\Dto\Phone\IndexDto as PhoneDto;
use App\Entity\Store;

final readonly class IndexDto
{
    /**
     * @param PhoneDto[] $phones
     */
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?bool $isActive = true,
        public ?AddressDto $address = null,
        public ?array $phones = null,
    ) {}

    public static function fromEntity(?Store $entity, bool $withRelations = false): static
    {
        if ($entity === null) {
            return new static();
        }

        if ($withRelations) {
            return new static(
                id: $entity->getId(),
                name: $entity->getName(),
                isActive: $entity->getIsActive(),
                address: AddressDto::fromEntity($entity->getAddress()),
                phones: PhoneDto::fromEntityArray($entity->getPhones()->toArray()),
            );
        }

        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            isActive: $entity->getIsActive(),
        );
    }
}
