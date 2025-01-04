<?php

namespace App\Dto\CashboxGlobal;

use App\Component\Paginator;
use App\Entity\CashboxDetail;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_global:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(entity: CashboxDetail::class)]
        public int $cashboxDetailId,
        #[Groups(['cashbox_global:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['cashbox_global:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }
}
