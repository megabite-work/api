<?php

namespace App\Action\Permission;

use App\Component\EntityNotFoundException;
use App\Dto\Permission\AssignDto;
use App\Entity\Permission;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(array $dtos): array
    {
        $user = $this->em->find(User::class, $dtos[0]->getUserId());
        if (null === $user) {
            throw new EntityNotFoundException('user not found');
        }
        $oldPermissions = array_map(fn ($id) => $this->em->find(Permission::class, $id), array_diff(
            array_map(fn ($dto) => $dto->getPermissionId(), $dtos),
            array_map(fn ($permission) => $permission->getId(), $user->getPermissions()->toArray())
        ));

        $this->em->beginTransaction();
        $entities = [];

        try {
            foreach ($dtos as $dto) {
                $entity = $this->assign($dto, $user);
                $entities[] = $entity;
            }
            foreach ($oldPermissions as $permission) {
                $user->removePermission($permission);
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new EntityNotFoundException($th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function assign(AssignDto $dto, User $user): Permission
    {
        $permission = $this->em->find(Permission::class, $dto->getPermissionId());

        if (null === $permission) {
            throw new EntityNotFoundException('permission not found');
        }

        $user->addPermission($permission);

        return $permission;
    }
}
