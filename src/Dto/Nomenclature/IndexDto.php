<?php

declare(strict_types=1);

namespace App\Dto\Nomenclature;

use App\Dto\Category\IndexDto as CategoryDto;
use App\Dto\ProviderList\IndexDto as ProviderListDto;
use App\Dto\StoreNomenclature\IndexDto as StoreNomenclatureDto;
use App\Dto\Unit\IndexDto as UnitDto;
use App\Dto\WebNomenclature\IndexDto as WebNomenclatureDto;
use App\Entity\Nomenclature;

final readonly class IndexDto
{
    /**
     * @param ProviderListDto $provider
     * @param CategoryDto $category
     * @param UnitDto $unit
     * @param StoreNomenclatureDto[] $storeNomenclatures
     * @param WebNomenclatureDto $webNomenclature
     */
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
        public ?string $mxik = null,
        public ?int $barcode = null,
        public ?string $brand = null,
        public ?float $oldPrice = 0,
        public ?float $price = 0,
        public ?float $oldPriceCourse = 0,
        public ?float $priceCourse = 0,
        public ?float $nds = 0,
        public ?float $discount = 0,
        public ?bool $qrCode = false,
        public ?int $totalQty = 0,
        public ?int $categoryId = null,
        private ?ProviderListDto $provider = null,
        private ?CategoryDto $category = null,
        private ?UnitDto $unit = null,
        private ?array $storeNomenclatures = null,
        private ?WebNomenclatureDto $webNomenclature = null,
        public ?bool $hasWebNomenclature = false,
    ) {}

    public static function fromCashboxGlobal(?Nomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName(),
                barcode: $entity->getBarcode(),
            )
            : null;
    }

    public static function fromEntity(?Nomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName(),
                mxik: $entity->getMxik(),
                barcode: $entity->getBarcode(),
                brand: $entity->getBrand(),
                oldPrice: $entity->getOldPrice(),
                price: $entity->getPrice(),
                oldPriceCourse: $entity->getOldPriceCourse(),
                priceCourse: $entity->getPriceCourse(),
                nds: $entity->getNds(),
                discount: $entity->getDiscount(),
                qrCode: $entity->getQrCode(),
            )
            : null;
    }

    public static function fromShowAction(?Nomenclature $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName(),
                mxik: $entity->getMxik(),
                barcode: $entity->getBarcode(),
                brand: $entity->getBrand(),
                oldPrice: $entity->getOldPrice(),
                price: $entity->getPrice(),
                oldPriceCourse: $entity->getOldPriceCourse(),
                priceCourse: $entity->getPriceCourse(),
                nds: $entity->getNds(),
                discount: $entity->getDiscount(),
                qrCode: $entity->getQrCode(),
                totalQty: $entity->getTotalQty(),
                category: CategoryDto::fromEntity($entity->getCategory()),
                unit: UnitDto::fromEntity($entity->getUnit()),
                storeNomenclatures: StoreNomenclatureDto::fromNomenclatureArray($entity->getStoreNomenclatures()->toArray()),
                webNomenclature: WebNomenclatureDto::fromEntityForNomenclature($entity->getWebNomenclature()),
            )
            : null;
    }
}
