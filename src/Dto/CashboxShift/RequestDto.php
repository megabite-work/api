<?php

namespace App\Dto\CashboxShift;

use App\Entity\CashboxShift;
use App\Entity\User;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        #[Exists(CashboxShift::class)]
        public ?int $cashboxId,
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        #[Exists(User::class)]
        public ?int $userId,
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        public ?int $shiftNumber
    ) {}
}
