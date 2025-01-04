<?php

namespace App\Dto\NomenclatureHistory;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['nomenclature_history:index'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:index'])]
        #[Assert\Type(type: ['integer'], groups: ['nomenclature_history:index'])]
        private ?int $storeId,
        #[Groups(['nomenclature_history:index'])]
        #[Assert\Positive(groups: ['nomenclature_history:index'])]
        private int $page = 1,
        #[Groups(['nomenclature_history:index'])]
        #[Assert\Positive(groups: ['nomenclature_history:index'])]
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

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }
}
