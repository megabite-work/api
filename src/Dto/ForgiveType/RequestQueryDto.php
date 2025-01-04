<?php

namespace App\Dto\ForgiveType;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['forgive_type:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['forgive_type:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
