<?php

namespace App\Dto\MultiStore;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['multi_store:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['multi_store:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
