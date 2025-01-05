<?php

namespace App\Dto\Nomenclature;

use App\Component\Paginator;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['integer'], groups: ['nomenclature:index'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['integer', 'null'], groups: ['nomenclature:index'])]
        #[Exists(Category::class)]
        public ?int $categoryId = null,
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['string', 'null'], groups: ['nomenclature:index'])]
        public ?string $name = null,
        #[Groups(['nomenclature:index'])]
        #[Assert\Positive(groups: ['nomenclature:index'])]
        public int $page = 1,
        #[Groups(['nomenclature:index'])]
        #[Assert\Positive(groups: ['nomenclature:index'])]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
