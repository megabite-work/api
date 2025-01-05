<?php

namespace App\Dto\Nomenclature;

use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\Unit;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['nomenclature:create', 'nomenclature:is_unique_barcode', 'nomenclature:is_unique_name'])]
        #[Assert\NotBlank(groups: ['nomenclature:create', 'nomenclature:is_unique_barcode', 'nomenclature:is_unique_name'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        #[Exists(Category::class)]
        public ?int $categoryId,
        #[Groups(['nomenclature:create', 'nomenclature:update', 'nomenclature:is_unique_barcode'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:is_unique_barcode'])]
        public ?int $barcode,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        public ?string $nameUz,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        public ?string $nameUzc,
        #[Groups(['nomenclature:create', 'nomenclature:update', 'nomenclature:is_unique_name'])]
        #[Assert\NotBlank(groups: ['nomenclature:create', 'nomenclature:is_unique_name'])]
        public ?string $nameRu,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(groups: ['nomenclature:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:update'])]
        #[Exists(Unit::class, 'code')]
        public ?int $unitCode,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?string $mxik = null,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create'])]
        public ?string $brand = null,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $oldPrice = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $price = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $oldPriceCourse = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $priceCourse = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $nds = 0,
        #[Groups(['nomenclature:create', 'nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['nomenclature:create', 'nomenclature:update'])]
        public ?float $discount = 0,
        #[Groups(['nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['nomenclature:update'])]
        public ?bool $qrCode = false
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
