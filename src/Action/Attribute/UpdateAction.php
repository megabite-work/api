<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Dto\Attribute\RequestDto;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(AttributeEntity::class, $id);
        $attributeName = $entity->getName();
        $name = [
            'ru' => $dto->nameRu ?? $attributeName['ru'],
            'uz' => $dto->nameUz ?? $attributeName['uz'],
            'uzc' => $dto->nameUzc ?? $attributeName['uzc'],
        ];
        $entity->setName($name);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
