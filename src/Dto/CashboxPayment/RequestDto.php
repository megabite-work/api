<?php

namespace App\Dto\CashboxPayment;

use App\Entity\CashboxDetail;
use App\Entity\PaymentType;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        #[Exists(CashboxDetail::class)]
        public ?int $cashboxDetailId,
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        #[Exists(PaymentType::class)]
        public ?int $paymentTypeId,
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        public ?float $amount
    ) {}
}
