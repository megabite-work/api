<?php

namespace App\Action\ForgiveType;

use App\Dto\ForgiveType\IndexDto;
use App\Dto\ForgiveType\RequestDto;
use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(ForgiveType::class, $id);
        $name = $entity->getName();
        $entity->setName([
            'ru' => $dto->nameRu ?? $name['ru'],
            'uz' => $dto->nameUz ?? $name['uz'],
            'uzc' => $dto->nameUzc ?? $name['uzc'],
        ]);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
