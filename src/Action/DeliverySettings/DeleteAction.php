<?php

namespace App\Action\DeliverySettings;

use App\Entity\DeliverySettings;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(DeliverySettings::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
