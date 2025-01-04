<?php

namespace App\Action\Attribute;

use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(AttributeEntity::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
