<?php

namespace App\Dto\DeliverySettings;

use App\Entity\DeliverySettings;
use App\Entity\Region;
use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['delivery_settings:create'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Exists(Store::class)]
        public int $storeId,
        #[Groups(['delivery_settings:create'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Exists(Region::class)]
        public int $regionId,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\Choice(choices: [DeliverySettings::DELIVERY_TYPE_FIXED, DeliverySettings::DELIVERY_TYPE_FLEXABLE])]
        public ?string $deliveryType,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        public ?float $minSum = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        public ?float $firstKm = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        public ?float $deliverySum = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        public ?float $nextKmSum = 0,
    ) {}
}
