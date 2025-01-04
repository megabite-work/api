<?php

namespace App\Dto\CounterPart;

use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['counter_part:create'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        #[Exists(MultiStore::class)]
        public int $multiStoreId,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        public string $name,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['counter_part:create'])]
        public ?string $inn,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['counter_part:create', 'counter_part:update'])]
        public ?float $discount,
        #[Groups(['counter_part:update'])]
        public ?string $region,
        #[Groups(['counter_part:update'])]
        public ?string $district,
        #[Groups(['counter_part:update'])]
        public ?string $street,
        #[Groups(['counter_part:update'])]
        public ?string $house,
        #[Groups(['counter_part:update'])]
        public ?string $latitude,
        #[Groups(['counter_part:update'])]
        public ?string $longitude,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        public ?array $phones,
    ) {}
}
