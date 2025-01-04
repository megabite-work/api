<?php

namespace App\Action\CashboxShift;

use App\Dto\CashboxShift\IndexDto;
use App\Entity\CashboxShift;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $entity = $this->em->find(CashboxShift::class, $id);
        $entity->setClosedAt(date_create());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
