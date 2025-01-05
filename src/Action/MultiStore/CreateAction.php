<?php

namespace App\Action\MultiStore;

use App\Component\CurrentUser;
use App\Dto\MultiStore\IndexDto;
use App\Dto\MultiStore\RequestDto;
use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new MultiStore())
            ->setName($dto->name)
            ->setProfit($dto->profit)
            ->setNds($dto->nds)
            ->setOwner($this->user->getUser());

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
