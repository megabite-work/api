<?php

namespace App\Action\CashboxGlobal;

use App\Entity\CashboxGlobal;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(CashboxGlobal::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
