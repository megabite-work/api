<?php

namespace App\Dto\Cashbox;

use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox:create', 'cashbox:update'])]
        #[Assert\NotBlank(groups: ['cashbox:create'])]
        public ?string $name,
        #[Groups(['cashbox:create'])]
        #[Assert\NotBlank(groups: ['cashbox:create'])]
        #[Exists(entity: Store::class)]
        public ?int $storeId,
        #[Groups(['cashbox:update'])]
        public ?string $terminalId,
        #[Groups(['cashbox:update'])]
        public ?int $shiftNumber,
        #[Groups(['cashbox:update'])]
        public ?int $zNumber,
        #[Groups(['cashbox:update'])]
        public ?int $xNumber,
        #[Groups(['cashbox:update'])]
        public ?string $workplace,
        #[Groups(['cashbox:update'])]
        public ?string $humoArcusFolder,
        #[Groups(['cashbox:update'])]
        #[Assert\Type('bool', groups: ['cashbox:update'])]
        public ?bool $isActive = true
    ) {}
}
