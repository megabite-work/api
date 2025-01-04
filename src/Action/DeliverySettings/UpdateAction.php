<?php

namespace App\Action\DeliverySettings;

use App\Dto\DeliverySettings\IndexDto;
use App\Dto\DeliverySettings\RequestDto;
use App\Entity\DeliverySettings;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(DeliverySettings::class, $id);
        $entity->setDeliveryType($dto->deliveryType ?? $entity->getDeliveryType())
            ->setMinSum($dto->minSum ?? $entity->getMinSum())
            ->setFirstKm($dto->firstKm ?? $entity->getFirstKm())
            ->setDeliverySum($dto->deliverySum ?? $entity->getDeliverySum())
            ->setNextKmSum($dto->nextKmSum ?? $entity->getNextKmSum());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
