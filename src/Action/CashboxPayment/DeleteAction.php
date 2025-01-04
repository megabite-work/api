<?php

namespace App\Action\CashboxPayment;

use App\Entity\CashboxPayment;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(CashboxPayment::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
