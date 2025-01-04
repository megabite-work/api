<?php

namespace App\Dto\CashboxPayment;

use App\Component\Paginator;
use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use App\Entity\PaymentType;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.cashboxDetailId != null',
            constraints: [new Assert\Positive()]
        )]
        #[Exists(CashboxDetail::class)]
        public ?int $cashboxDetailId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.getPaymentTypeId() != null',
            constraints: [new Assert\Positive()]
        )]
        #[Exists(PaymentType::class)]
        public ?int $paymentTypeId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.paymentTypeId != null && this.cashboxDetailId == null',
            constraints: [new Assert\NotBlank(message: 'cashboxId should not be blank.'), new Assert\Positive()]
            )]
        #[Exists(Cashbox::class)]
        public ?int $cashboxId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
