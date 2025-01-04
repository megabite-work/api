<?php

namespace App\Action\WebEvent;

use App\Component\EntityNotFoundException;
use App\Dto\WebEvent\RequestDto;
use App\Entity\MultiStore;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(RequestDto $dto): WebEvent
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebEvent
    {
        $entity = (new WebEvent())
            ->setMultiStoreId($dto->getMultiStoreId())
            ->setType($dto->getType())
            ->setTypeIds($dto->getTypeIds())
            ->setTitle($dto->getTitle())
            ->setDelay($dto->getDelay())
            ->setMove($dto->getMove())
            ->setAnimation($dto->getAnimation());

        $this->em->persist($entity);

        return $entity;
    }
}
