<?php

namespace App\Dto\Cashbox;

use App\Component\Paginator;
use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(entity: Store::class)]
        public int $storeId,
        #[Groups(['cashbox:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['cashbox:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
