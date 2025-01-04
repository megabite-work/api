<?php

namespace App\Dto\PaymentType;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        #[Assert\Choice(choices: ['ordinary', 'e-wallets'], groups: ['payment_type:create'])]
        private ?string $type,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        private ?string $nameUz,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        private ?string $nameUzc,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        private ?string $nameRu,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        private ?string $nameEn,
    ) {
    }

    public function getName(): ?array
    {
        return ['en' => $this->getNameEn(), 'ru' => $this->getNameRu(), 'uz' => $this->getNameUz(), 'uzc' => $this->getNameUzc()];
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getNameUz(): ?string
    {
        return $this->nameUz;
    }

    public function getNameUzc(): ?string
    {
        return $this->nameUzc;
    }

    public function getNameRu(): ?string
    {
        return $this->nameRu;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }
}
