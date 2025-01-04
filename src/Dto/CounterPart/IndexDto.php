<?php

namespace App\Dto\CounterPart;

use App\Dto\Address\IndexDto as AddressDto;
use App\Dto\Phone\IndexDto as PhoneDto;
use App\Entity\CounterPart;

final readonly class IndexDto
{
    /**
     * @param PhoneDto[] $phones
     */
    public function __construct(
        public ?int $id = null,
        public ?int $multiStoreId = null,
        public ?string $name = null,
        public ?string $inn = null,
        public ?float $discount = null,
        public ?AddressDto $address = null,
        public ?array $phones = null,
    ) {}

    public static function fromEntity(?CounterPart $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            inn: $entity->getInn(),
            discount: $entity->getDiscount(),
            address: AddressDto::fromEntity($entity->getAddress()),
            phones: PhoneDto::fromEntityArray($entity->getPhones()->toArray()),
        );
    }
}
