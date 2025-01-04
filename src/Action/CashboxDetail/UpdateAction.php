<?php

namespace App\Action\CashboxDetail;

use App\Dto\CashboxDetail\IndexDto;
use App\Dto\CashboxDetail\RequestDto;
use App\Entity\CashboxDetail;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(CashboxDetail::class, $id);
        $entity->setReturnStatus($dto->returnStatus)
            ->setCreditStatus($dto->creditStatus)
            ->setSurrender($dto->surrender ?? $entity->getSurrender())
            ->setSale($dto->sale ?? $entity->getSale())
            ->setDiscount($dto->discount ?? $entity->getDiscount())
            ->setNds($dto->nds ?? $entity->getNds())
            ->setAdvance($dto->advance ?? $entity->getAdvance())
            ->setCredit($dto->credit ?? $entity->getCredit())
            ->setRemain($dto->remain ?? $entity->getRemain());
        $this->em->flush();

        return IndexDto::fromEntityUpdate($entity);
    }
}
