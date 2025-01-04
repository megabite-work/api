<?php

namespace App\Action\MultiStore;

use App\Component\EntityNotFoundException;
use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $multiStore = $this->em->find(MultiStore::class, $id);

        if (null === $multiStore) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($multiStore);
        $this->em->flush();

        return true;
    }
}
