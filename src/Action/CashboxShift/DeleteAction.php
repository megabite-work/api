<?php

namespace App\Action\CashboxShift;

use App\Entity\CashboxShift;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(CashboxShift::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
