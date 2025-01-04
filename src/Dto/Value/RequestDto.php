<?php

namespace App\Dto\Value;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['value:create'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        private ?int $attributeId,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        private ?string $nameUz,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        private ?string $nameUzc,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        private ?string $nameRu,
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

    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }
}
