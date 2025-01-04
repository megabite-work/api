<?php

namespace App\Action\MultiStore;

use App\Component\CurrentUser;
use App\Dto\MultiStore\RequestDto;
use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CurrentUser $user
    ) {
    }

    public function __invoke(RequestDto $dto): MultiStore
    {
        $multiStore = (new MultiStore())
            ->setName($dto->getName())
            ->setProfit($dto->getProfit())
            ->setNds($dto->getNds())
            ->setOwner($this->user->getUser());

        $this->em->persist($multiStore);
        $this->em->flush();

        return $multiStore;
    }
}
