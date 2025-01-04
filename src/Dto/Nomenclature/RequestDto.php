<?php

namespace App\Dto\Nomenclature;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['nomenclature:create', 'nomenclature:is_unique_barcode', 'nomenclature:is_unique_name'])]
        #[Assert\NotBlank(groups: ['nomenclature:create', 'nomenclature:is_unique_barcode', 'nomenclature:is_unique_name'])]
        private ?int $multiStoreId,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        private ?int $categoryId,
        #[Groups(['nomenclature:create', 'nomenclature:update', 'nomenclature:is_unique_barcode'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:is_unique_barcode'])]
        private ?int $barcode,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        private ?string $nameUz,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        private ?string $nameUzc,
        #[Groups(['nomenclature:create', 'nomenclature:update', 'nomenclature:is_unique_name'])]
        #[Assert\NotBlank(groups: ['nomenclature:create', 'nomenclature:is_unique_name'])]
        private ?string $nameRu,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:update'])]
        private ?int $unitCode,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?string $mxik = null,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create'])]
        private ?string $brand = null,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $oldPrice = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $price = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $oldPriceCourse = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $priceCourse = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $nds = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        private ?float $discount = 0,
        #[Groups(['nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['nomenclature:update'])]
        private ?bool $qrCode = false
    ) {
    }

    public function getNameUz(): ?string
    {
        return $this->nameUz;
    }

    public function getNameUzc(): ?string
    {
        return $this->nameUzc;
    }

    public function getNameRu(): ?string
    {
        return $this->nameRu;
    }

    public function getName(): ?array
    {
        return ['ru' => $this->getNameRu(), 'uz' => $this->getNameUz(), 'uzc' => $this->getNameUzc()];
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getBarcode(): ?int
    {
        return $this->barcode;
    }

    public function getMxik(): ?string
    {
        return $this->mxik;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
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

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getQrCode(): ?bool
    {
        return $this->qrCode;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getUnitCode(): ?int
    {
        return $this->unitCode;
    }
}
