<?php

namespace App\Action\CashboxDetail;

use App\Entity\CashboxDetail;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(CashboxDetail::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
