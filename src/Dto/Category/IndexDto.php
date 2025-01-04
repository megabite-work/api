<?php

namespace App\Dto\Category;

use App\Entity\Category;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $parentId = null,
        public ?array $name = null,
        public ?string $image = null,
        public ?bool $isActive = null,
        public ?bool $hasChild = false,
    ) {}

    public static function fromEntity(?Category $category): static
    {
        return new static(
            id: $category->getId(),
            parentId: $category->getParentId(),
            name: $category->getName(),
            image: $category->getImage(),
            isActive: $category->getIsActive(),
            hasChild: $category->getHasChild(),
        );
    }
}
