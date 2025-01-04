<?php

namespace App\Action\ForgiveType;

use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(ForgiveType::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
