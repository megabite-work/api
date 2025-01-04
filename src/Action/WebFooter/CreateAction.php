<?php

namespace App\Action\WebFooter;

use App\Component\EntityNotFoundException;
use App\Dto\WebFooter\RequestDto;
use App\Entity\MultiStore;
use App\Entity\WebFooter;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function __invoke(RequestDto $dto): WebFooter
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): WebFooter
    {
        $entity = (new WebFooter())
            ->setMultiStoreId($dto->getMultiStoreId())
            ->setType($dto->getType())
            ->setTitle($dto->getTitle())
            ->setOrder($dto->getOrder())
            ->setIsActive($dto->getIsActive());

        $this->em->persist($entity);

        return $entity;
    }
}
