<?php

namespace App\Action\Permission;

use App\Dto\Permission\RequestDto;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function __invoke(RequestDto $dto): Permission
    {
        $entity = $this->create($dto);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto): Permission
    {
        $entity = $this->em->getRepository(Permission::class)->findOneBy(
            [
                'resource' => $dto->getResource(),
                'action' => $dto->getAction(),
            ]
        );

        if ($entity) {
            return $entity;
        }

        $entity = (new Permission())
            ->setName($dto->getName())
            ->setResource($dto->getResource())
            ->setAction($dto->getAction())
            ->setIcon($dto->getIcon());

        $this->em->persist($entity);

        return $entity;
    }
}
