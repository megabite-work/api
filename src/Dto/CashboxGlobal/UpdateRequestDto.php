<?php

namespace App\Dto\CashboxGlobal;

use App\Entity\Nomenclature;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateRequestDto
{
    public function __construct(
        #[Assert\NotBlank(groups: ['cashbox_global:create'])]
        #[Exists(Nomenclature::class)]
        public ?int $nomenclatureId,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $qty = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $oldPrice = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $price = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $oldPriceCourse = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $priceCourse = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $nds = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $ndsSum = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $discount = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        public ?float $discountSum = 0,
    ) {}
}
