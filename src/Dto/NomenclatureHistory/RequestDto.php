<?php

namespace App\Dto\NomenclatureHistory;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:create'])]
        private ?int $storeId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:create'])]
        private ?int $nomenclatureId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?int $forgiveTypeId,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?string $comment,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?float $qty = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?float $oldPrice = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?float $price = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?float $oldPriceCourse = 0,
        #[Groups(['nomenclature_history:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature_history:create'])]
        private ?float $priceCourse = 0,
    ) {
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function getForgiveTypeId(): ?int
    {
        return $this->forgiveTypeId;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getOldPriceCourse(): ?float
    {
        return $this->oldPriceCourse;
    }

    public function getPriceCourse(): ?float
    {
        return $this->priceCourse;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }
}
