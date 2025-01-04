<?php

namespace App\Action\CounterPart;

use App\Entity\CounterPart;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(CounterPart::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
