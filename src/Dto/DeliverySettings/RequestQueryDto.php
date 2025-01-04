<?php

namespace App\Dto\DeliverySettings;

use App\Component\Paginator;
use App\Entity\MultiStore;
use App\Entity\Region;
use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank]
        #[Exists(MultiStore::class)]
        public int $multiStoreId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Exists(Store::class)]
        public ?int $storeId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Exists(Region::class)]
        public ?int $regionId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['delivery_settings:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
