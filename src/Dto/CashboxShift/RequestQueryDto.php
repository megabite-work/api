<?php

namespace App\Dto\CashboxShift;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_shift:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $cashboxId,
        #[Groups(['cashbox_shift:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['cashbox_shift:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
