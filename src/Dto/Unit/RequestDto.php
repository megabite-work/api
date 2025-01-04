<?php

namespace App\Dto\Unit;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        private ?string $nameUz,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        private ?string $nameUzc,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        private ?string $nameRu,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['unit:create', 'unit:update'])]
        private ?string $icon,
        #[Groups(['unit:create'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        private ?int $code
    ) {
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

    public function getName(): ?array
    {
        return ['ru' => $this->getNameRu(), 'uz' => $this->getNameUz(), 'uzc' => $this->getNameUzc()];
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }
}
