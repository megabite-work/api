<?php

namespace App\Action\MultiStore;

use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $multiStore = $this->em->find(MultiStore::class, $id);
        $this->em->remove($multiStore);
        $this->em->flush();
    }
}
