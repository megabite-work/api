<?php

namespace App\Dto\CashboxDetail;

use App\Component\Paginator;
use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_detail:index'])]
        #[Assert\NotBlank(groups: ['cashbox_detail:index'])]
        #[Assert\Positive]
        #[Exists(entity: Cashbox::class)]
        public int $cashboxId,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: [CashboxDetail::TYPE_SALE, CashboxDetail::TYPE_RETURN, null])]
        public ?string $type = null,
        #[Groups(['cashbox_detail:index'])]
        public ?bool $returnStatus = null,
        #[Groups(['cashbox_detail:index'])]
        public ?bool $creditStatus = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: [CashboxDetail::CREDIT_TYPE_CREDIT, CashboxDetail::CREDIT_TYPE_ADVANCE, CashboxDetail::CREDIT_TYPE_PAY, null])]
        public ?string $creditType = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }
}
