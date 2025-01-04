<?php

namespace App\Dto\Attribute;

use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestDto
{
    public function __construct(
        #[Groups(['attribute:create'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        #[Exists(entity: Category::class)]
        public ?int $categoryId,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameUz,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameUzc,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameRu,
    ) {
    }

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
