<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);

        if (null === $webNomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($webNomenclature);
        $this->em->flush();

        return true;
    }
}
