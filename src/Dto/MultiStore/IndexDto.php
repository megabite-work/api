<?php

declare(strict_types=1);

namespace App\Dto\MultiStore;

use App\Dto\Address\IndexDto as AddressDto;
use App\Dto\Phone\IndexDto as PhoneDto;
use App\Dto\Store\IndexDto as StoreDto;
use App\Dto\WebCredential\IndexDto as WebCredentialDto;
use App\Entity\MultiStore;

final readonly class IndexDto
{
    /** 
     * @param \App\Dto\Phone\IndexDto[] $stores
     * @param \App\Dto\Store\IndexDto[] $phones
     */
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public string|array|null $profit = null,
        public ?int $barcodeTtn = null,
        public ?int $nds = null,
        public ?int $storesCount = null,
        public ?int $workersCount = null,
        public ?WebCredentialDto $webCredential = null,
        public ?AddressDto $address = null,
        public ?array $stores = null,
        public ?array $phones = null,
    ) {}

    public static function fromEntity(?MultiStore $entity): static
    {
        return new static(
            id: $entity?->getId(),
            name: $entity?->getName(),
            profit: $entity?->getProfit(),
            barcodeTtn: $entity?->getBarcodeTtn(),
            nds: $entity?->getNds(),
        );
    }

    public static function fromIndexAction(?MultiStore $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            profit: $entity->getProfit(),
            barcodeTtn: $entity->getBarcodeTtn(),
            nds: $entity->getNds(),
            storesCount: $entity->getStoresCount(),
            workersCount: $entity->getWorkersCount(),
        );
    }

    public static function fromShowAction(?MultiStore $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            profit: $entity->getProfit(),
            barcodeTtn: $entity->getBarcodeTtn(),
            nds: $entity->getNds(),
            stores: StoreDto::fromEntityArray($entity->getStores()->toArray()),
            webCredential: WebCredentialDto::fromEntity($entity->getWebCredential()),
            address: AddressDto::fromEntity($entity->getAddress()),
            phones: PhoneDto::fromEntityArray($entity->getPhones()->toArray()),
        );
    }
}
