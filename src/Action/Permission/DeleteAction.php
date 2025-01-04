<?php

namespace App\Action\Permission;

use App\Component\EntityNotFoundException;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $entity = $this->em->find(Permission::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }
}
