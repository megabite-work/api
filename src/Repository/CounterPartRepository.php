<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\CounterPart\RequestQueryDto;
use App\Entity\CounterPart;
use App\Entity\MultiStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CounterPart>
 */
class CounterPartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterPart::class);
    }

    public function findAllCounterPartsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->getReference(MultiStore::class, $dto->multiStoreId);

        $query = $entityManager->createQuery(
            'SELECT c, a, p
            FROM App\Entity\CounterPart c
            LEFT JOIN c.address a
            LEFT JOIN c.phones p
            WHERE c.multiStore = :multiStore'
        )->setParameter('multiStore', $multiStore);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findCounterPartWithAddressAndPhonesById(int $id): ?CounterPart
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, a, p
            FROM App\Entity\CounterPart c
            LEFT JOIN c.address a
            LEFT JOIN c.phones p
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
