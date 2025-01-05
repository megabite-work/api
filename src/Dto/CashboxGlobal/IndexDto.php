<?php

namespace App\Dto\CashboxGlobal;

use App\Dto\Nomenclature\IndexDto as NomenclatureDto;
use App\Entity\CashboxGlobal;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?float $qty = null,
        public ?float $oldPrice = null,
        public ?float $price = null,
        public ?float $oldPriceCourse = null,
        public ?float $priceCourse = null,
        public ?float $nds = null,
        public ?float $ndsSum = null,
        public ?float $discount = null,
        public ?float $discountSum = null,
        public ?NomenclatureDto $nomenclature = null,
    ) {}

    public static function fromEntity(?CashboxGlobal $entity): static
    {
        return new static(
            id: $entity->getId(),
            qty: $entity->getQty(),
            oldPrice: $entity->getOldPrice(),
            price: $entity->getPrice(),
            oldPriceCourse: $entity->getOldPriceCourse(),
            priceCourse: $entity->getPriceCourse(),
            nds: $entity->getNds(),
            ndsSum: $entity->getNdsSum(),
            discount: $entity->getDiscount(),
            discountSum: $entity->getDiscountSum(),
            nomenclature: NomenclatureDto::fromCashboxGlobal($entity->getNomenclature()),
        );
    }
}
