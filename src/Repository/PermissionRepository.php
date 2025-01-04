<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Permission\RequestQueryDto;
use App\Entity\Permission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Permission>
 */
class PermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    public function findAllPermissions(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Permission p'
        );

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function hasPermissionsByUser(int $userId, string $resource, string $action): bool
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Permission p
            JOIN p.users u
            WHERE u.id = :id AND p.resource = :resource  AND p.action = :action'
        )->setParameters(['id' => $userId, 'resource' => $resource, 'action' => $action]);

        return null !== $query->getOneOrNullResult();
    }
}
