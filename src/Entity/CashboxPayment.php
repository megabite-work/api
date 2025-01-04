<?php

namespace App\Entity;

use App\Repository\CashboxPaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CashboxPaymentRepository::class)]
#[Gedmo\SoftDeleteable]
class CashboxPayment
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cashboxPayments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private ?CashboxDetail $cashboxDetail = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private ?PaymentType $paymentType = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, options: ['default' => 0])]
    #[Groups(['cashbox_payment:index', 'cashbox_payment:show', 'cashbox_payment:create'])]
    private float|string|null $amount = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCashboxDetail(): ?CashboxDetail
    {
        return $this->cashboxDetail;
    }

    public function setCashboxDetail(?CashboxDetail $cashboxDetail): static
    {
        $this->cashboxDetail = $cashboxDetail;

        return $this;
    }

    public function getPaymentType(): ?PaymentType
    {
        return $this->paymentType;
    }

    public function setPaymentType(?PaymentType $paymentType): static
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): static
    {
        $this->amount = $amount ?? 0;

        return $this;
    }
}
