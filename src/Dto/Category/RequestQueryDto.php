<?php

namespace App\Dto\Category;

use App\Component\Paginator;
use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestQueryDto
{
    public function __construct(
        #[Groups(['category:index'])]
        #[Assert\Type(type: ['integer', 'null'])]
        #[Exists(entity: Category::class)]
        public ?int $parentId = null,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        public ?int $page = 1,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        public ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
