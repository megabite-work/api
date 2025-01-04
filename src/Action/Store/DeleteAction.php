<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $store = $this->em->find(Store::class, $id);

        if (null === $store) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($store);
        $this->em->flush();

        return true;
    }
}
