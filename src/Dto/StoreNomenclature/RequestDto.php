<?php

namespace App\Dto\StoreNomenclature;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['store_nomenclature:create'])]
        #[Assert\NotBlank(groups: ['store_nomenclature:create'])]
        private ?int $nomenclatureId,
        #[Groups(['store_nomenclature:create', 'store_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['store_nomenclature:create', 'store_nomenclature:update'])]
        private ?float $qty
    ) {
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }
}
