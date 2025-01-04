<?php

namespace App\Action\CashboxShift;

use App\Dto\CashboxShift\IndexDto;
use App\Dto\CashboxShift\RequestDto;
use App\Entity\Cashbox;
use App\Entity\CashboxShift;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): IndexDto
    {
        $cashbox = $this->em->getReference(Cashbox::class, $dto->cashboxId);
        $user = $this->em->getReference(User::class, $dto->userId);

        $entity = (new CashboxShift())
            ->setShiftNumber($dto->shiftNumber)
            ->setUser($user)
            ->setCashbox($cashbox);

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
