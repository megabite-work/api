<?php

namespace App\Action\DeliverySettings;

use App\Dto\DeliverySettings\IndexDto;
use App\Dto\DeliverySettings\RequestDto;
use App\Entity\DeliverySettings;
use App\Entity\Region;
use App\Entity\Store;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(array $dtos): array
    {
        $this->em->beginTransaction();
        $entities = [];

        try {
            $entities = array_map(fn($dto) => IndexDto::fromEntity($this->create($dto)), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('DeliverySettings', $th->getMessage());
        }

        return $entities;
    }

    private function create(RequestDto $dto): DeliverySettings
    {
        $store = $this->em->getReference(Store::class, $dto->storeId);
        $region = $this->em->getReference(Region::class, $dto->regionId);

        $entity = (new DeliverySettings())
            ->setDeliveryType($dto->deliveryType)
            ->setMinSum($dto->minSum)
            ->setFirstKm($dto->firstKm)
            ->setDeliverySum($dto->deliverySum)
            ->setNextKmSum($dto->nextKmSum)
            ->setStore($store)
            ->setRegion($region);

        $this->em->persist($entity);

        return $entity;
    }
}
