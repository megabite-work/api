<?php

namespace App\Action\Cashbox;

use App\Entity\Cashbox;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): void
    {
        $cashbox = $this->em->find(Cashbox::class, $id);
        $this->em->remove($cashbox);
        $this->em->flush();
    }
}
