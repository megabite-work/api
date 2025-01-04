<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Cashbox\RequestQueryDto;
use App\Entity\Cashbox;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cashbox>
 */
class CashboxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cashbox::class);
    }

    public function findAllCashboxesByStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $dto->storeId);

        $query = $em->createQuery(
            'SELECT c, s
            FROM App\Entity\Cashbox c
            JOIN c.store s
            WHERE c.store = :store'
        )->setParameter('store', $store);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findCashboxByIdWithStore(int $id): ?Cashbox
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT c, s
            FROM App\Entity\Cashbox c
            JOIN c.store s
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function hasCashboxByNameAndStore(Store $store, string $name): bool
    {
        return null !== $this->findOneBy(['name' => $name, 'store' => $store]);
    }
}
