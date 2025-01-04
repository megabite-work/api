<?php

namespace App\Action\Nomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $nomenclature = $this->em->find(Nomenclature::class, $id);

        if (null === $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($nomenclature);
        $this->em->flush();

        return true;
    }
}
