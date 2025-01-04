<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Attribute\RequestQueryDto;
use App\Entity\AttributeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributeEntity>
 */
class AttributeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeEntity::class);
    }

    public function findAllAttributesByCategory(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\AttributeEntity a
            JOIN a.categories c
            WHERE c.id = :cid'
        )->setParameter('cid', $dto->categoryId);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
