<?php

namespace App\Action\Nomenclature;

use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $nomenclature = $this->em->find(Nomenclature::class, $id);
        $this->em->remove($nomenclature);
        $this->em->flush();
    }
}
