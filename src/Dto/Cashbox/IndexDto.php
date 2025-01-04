<?php

namespace App\Dto\Cashbox;

use App\Entity\Cashbox;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?int $storeId = null,
        public ?string $terminalId = null,
        public ?string $workplace = null,
        public ?int $shiftNumber = null,
        public ?int $zNumber = null,
        public ?int $xNumber = null,
        public ?string $humoArcusFolder = null,
        public ?bool $isActive = null,
    ) {}

    public static function fromEntity(?Cashbox $entity): static
    {
        return new static(
            id: $entity->getId(),
            name: $entity->getName(),
            storeId: $entity->getStoreId(),
            terminalId: $entity->getTerminalId(),
            workplace: $entity->getWorkplace(),
            shiftNumber: $entity->getShiftNumber(),
            zNumber: $entity->getZNumber(),
            xNumber: $entity->getXNumber(),
            humoArcusFolder: $entity->getHumoArcusFolder(),
            isActive: $entity->getIsActive(),
        );
    }
}
