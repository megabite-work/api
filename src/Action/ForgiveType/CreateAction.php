<?php

namespace App\Action\ForgiveType;

use App\Dto\ForgiveType\IndexDto;
use App\Dto\ForgiveType\RequestDto;
use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new ForgiveType())
            ->setName($dto->getName());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
