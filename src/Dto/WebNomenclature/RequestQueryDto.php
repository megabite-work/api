<?php

namespace App\Dto\WebNomenclature;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:index'])]
        #[Assert\Positive]
        private int $multiStoreId,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:index'])]
        private ?int $nomenclatureId,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:index'])]
        private ?int $categoryId,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:index'])]
        private ?string $title,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:index'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:index'])]
        private ?bool $isActive = null,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['web_nomenclature:index'])]
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

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
}
