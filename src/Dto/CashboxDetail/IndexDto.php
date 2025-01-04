<?php

namespace App\Dto\CashboxDetail;

use App\Dto\Cashbox\IndexDto as CashboxDto;
use App\Dto\CounterPart\IndexDto as CounterPartDto;
use App\Dto\User\IndexDto as UserDto;
use App\Entity\CashboxDetail;

final readonly class IndexDto
{
    /**
     * @param IndexDto[] $cashboxDetails
     */
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public ?int $chequeNumber = null,
        public ?string $creditType = null,
        public ?bool $returnStatus = false,
        public ?bool $creditStatus = null,
        public ?float $surrender = 0,
        public ?float $sale = 0,
        public ?float $discount = 0,
        public ?float $nds = 0,
        public ?float $advance = 0,
        public ?float $credit = 0,
        public ?float $remain = 0,
        public ?array $cashboxDetails = null,
        public ?CashboxDto $cashbox = null,
        public ?UserDto $user = null,
        public ?CounterPartDto $counterPart = null,
    ) {}

    public static function fromEntity(?CashboxDetail $entity): static
    {
        return new static(
            id: $entity->getId(),
            type: $entity->getType(),
            chequeNumber: $entity->getChequeNumber(),
            creditType: $entity->getCreditType(),
            returnStatus: $entity->getReturnStatus(),
            creditStatus: $entity->getCreditStatus(),
            surrender: $entity->getSurrender(),
            sale: $entity->getSale(),
            discount: $entity->getDiscount(),
            nds: $entity->getNds(),
            advance: $entity->getAdvance(),
            credit: $entity->getCredit(),
            remain: $entity->getRemain(),
            cashbox: CashboxDto::fromEntity($entity->getCashbox()),
            user: UserDto::fromEntity($entity->getUser()),
            counterPart: CounterPartDto::fromEntity($entity->getCounterPart()),
        );
    }

    public static function fromEntities(array $entities = []): array
    {
        return array_map(fn(CashboxDetail $entity) => static::fromEntity($entity),  $entities);
    }

    public static function fromEntityUpdate(?CashboxDetail $entity): static
    {
        return new static(
            id: $entity->getId(),
            type: $entity->getType(),
            chequeNumber: $entity->getChequeNumber(),
            creditType: $entity->getCreditType(),
            returnStatus: $entity->getReturnStatus(),
            creditStatus: $entity->getCreditStatus(),
            surrender: $entity->getSurrender(),
            sale: $entity->getSale(),
            discount: $entity->getDiscount(),
            nds: $entity->getNds(),
            advance: $entity->getAdvance(),
            credit: $entity->getCredit(),            
            remain: $entity->getRemain(),
        );
    }
}
