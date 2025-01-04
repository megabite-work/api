<?php

namespace App\Dto\CashboxDetail;

use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use App\Entity\CounterPart;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_detail:create'])]
        #[Assert\NotBlank(groups: ['cashbox_detail:create'])]
        #[Exists(entity: Cashbox::class)]
        public int $cashboxId,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\Choice(choices: [CashboxDetail::TYPE_SALE, CashboxDetail::TYPE_RETURN])]
        public ?string $type,
        #[Groups(['cashbox_detail:create'])]
        #[Exists(entity: CounterPart::class)]
        public ?int $counterPartId,
        #[Groups(['cashbox_detail:create'])]
        #[Exists(entity: CashboxDetail::class)]
        public ?int $detailId,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\Choice(choices: [CashboxDetail::CREDIT_TYPE_CREDIT, CashboxDetail::CREDIT_TYPE_ADVANCE, CashboxDetail::CREDIT_TYPE_PAY, null])]
        public ?string $creditType = null,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public bool $returnStatus = false,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public ?bool $creditStatus = null,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $surrender = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $sale = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $discount = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $nds = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $advance = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $credit = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        public float $remain = 0,
    ) {
    }
}
