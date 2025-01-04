<?php

namespace App\Dto\Store;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['store:create', 'store:update'])]
        #[Assert\NotBlank(groups: ['store:create'])]
        private ?string $name,
        #[Groups(['store:create'])]
        #[Assert\NotBlank(groups: ['store:create'])]
        private ?int $multiStoreId,
        #[Groups(['store:update'])]
        private ?string $region,
        #[Groups(['store:update'])]
        private ?string $district,
        #[Groups(['store:update'])]
        private ?string $street,
        #[Groups(['store:update'])]
        private ?string $house,
        #[Groups(['store:update'])]
        private ?string $latitude,
        #[Groups(['store:update'])]
        private ?string $longitude,
        #[Groups(['store:update'])]
        private ?array $phones,
        #[Groups(['store:update'])]
        #[Assert\Type('bool', groups: ['store:update'])]
        private ?bool $isActive = true
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function getPhones(): array
    {
        return $this->phones ?? [];
    }
}
