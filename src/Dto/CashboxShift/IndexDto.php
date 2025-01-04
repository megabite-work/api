<?php

namespace App\Dto\CashboxShift;

use App\Dto\User\IndexDto as UserDto;
use App\Entity\CashboxShift;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $shiftNumber = null,
        public ?string $openedAt = null,
        public ?string $closedAt = null,
        public ?UserDto $user = null,
        public ?int $userId = null,
    ) {}

    public static function fromEntity(?CashboxShift $entity): static
    {
        return new static(
            id: $entity->getId(),
            shiftNumber: $entity->getShiftNumber(),
            openedAt: $entity->getCreatedAt(),
            closedAt: $entity->getClosedAt(),
            user: UserDto::fromEntity($entity->getUser()),
        );
    }
}
