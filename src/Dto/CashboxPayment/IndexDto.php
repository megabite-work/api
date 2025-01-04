<?php

namespace App\Dto\CashboxPayment;

use App\Dto\CashboxDetail\IndexDto as CashboxDetailDto;
use App\Dto\PaymentType\IndexDto as PaymentTypeDto;
use App\Entity\CashboxPayment;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?float $amount = null,
        public ?CashboxDetailDto $cashboxDetail = null,
        public ?PaymentTypeDto $paymentType = null,
    ) {}

    public static function fromEntity(?CashboxPayment $entity): static
    {
        return new static(
            id: $entity->getId(),
            amount: $entity->getAmount(),
            cashboxDetail: CashboxDetailDto::fromEntity($entity->getCashboxDetail()),
            paymentType: PaymentTypeDto::fromEntity($entity->getPaymentType()),
        );
    }
}
