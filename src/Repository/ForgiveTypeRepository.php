<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\ForgiveType\RequestQueryDto;
use App\Entity\ForgiveType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForgiveType>
 */
class ForgiveTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForgiveType::class);
    }

    public function findAllForgiveTypes(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT f
            FROM App\Entity\ForgiveType f'
        );

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findForgiveTypeById(int $id): ?ForgiveType
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT f
            FROM App\Entity\ForgiveType f
            WHERE f.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
