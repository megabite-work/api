<?php

namespace App\Action\Permission;

use App\Component\EntityNotFoundException;
use App\Dto\Permission\RequestDto;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Permission
    {
        $entity = $this->update($dto, $id);

        $this->em->flush();

        return $entity;
    }

    private function update(RequestDto $dto, int $id): Permission
    {
        $entity = $this->em->find(Permission::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $permissionName = $entity->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $permissionName['ru'],
                'uz' => $dto->getNameUz() ?? $permissionName['uz'],
                'uzc' => $dto->getNameUzc() ?? $permissionName['uzc'],
            ];

            $entity->setName($name);
        }
        if ($dto->getIcon()) {
            $entity->setIcon($dto->getIcon());
        }
        if ($dto->getResource()) {
            $entity->setResource($dto->getResource());
        }
        if ($dto->getAction()) {
            $entity->setAction($dto->getAction());
        }

        return $entity;
    }
}
