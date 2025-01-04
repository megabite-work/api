<?php

namespace App\Dto\Category;

use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['category:create', 'category:update'])]
        #[Exists(entity: Category::class)]
        public ?int $parentId,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        public ?string $nameUz,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        public ?string $nameUzc,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        public ?string $nameRu,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['category:create', 'category:update'])]
        public ?string $image,
        #[Groups(['category:update'])]
        #[Assert\Type('bool', groups: ['category:update'])]
        public ?bool $isActive = true
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
