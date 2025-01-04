<?php

namespace App\Dto\Nomenclature;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['integer'], groups: ['nomenclature:index'])]
        private ?int $multiStoreId,
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['integer', 'null'], groups: ['nomenclature:index'])]
        private ?int $categoryId = null,
        #[Groups(['nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:index'])]
        #[Assert\Type(type: ['string', 'null'], groups: ['nomenclature:index'])]
        private ?string $name = null,
        #[Groups(['nomenclature:index'])]
        #[Assert\Positive(groups: ['nomenclature:index'])]
        private int $page = 1,
        #[Groups(['nomenclature:index'])]
        #[Assert\Positive(groups: ['nomenclature:index'])]
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

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
