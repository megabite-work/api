<?php

namespace App\Dto\StoreNomenclature;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['store_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['store_nomenclature:index'])]
        #[Assert\Type(type: ['integer', 'null'], groups: ['store_nomenclature:index'])]
        private ?int $categoryId = null,
        #[Groups(['store_nomenclature:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['store_nomenclature:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
}
