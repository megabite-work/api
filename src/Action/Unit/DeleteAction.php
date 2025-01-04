<?php

namespace App\Action\Unit;

use App\Component\EntityNotFoundException;
use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $unit = $this->em->find(Unit::class, $id);

        if (null === $unit) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($unit);
        $this->em->flush();

        return true;
    }
}
