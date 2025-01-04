<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\NomenclatureHistory\RequestQueryDto;
use App\Entity\NomenclatureHistory;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomenclatureHistory>
 */
class NomenclatureHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomenclatureHistory::class);
    }

    public function findAllNomenclatureHistoriesWithAllJoines(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $dto->getStoreId());

        $query = $entityManager->createQuery(
            'SELECT nh, s, n, c, u, f, o
            FROM App\Entity\NomenclatureHistory nh
            JOIN nh.store s
            JOIN nh.nomenclature n
            LEFT JOIN nh.forgiveType f
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.provider f
            JOIN nh.owner o
            WHERE nh.store = :store'
        )->setParameter('store', $store);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findNomenclatureHistoryById(int $id): ?NomenclatureHistory
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT nh, s, n, c, u, f, o
            FROM App\Entity\NomenclatureHistory nh
            JOIN nh.store s
            JOIN nh.nomenclature n
            LEFT JOIN nh.forgiveType f
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.provider f
            JOIN nh.owner o
            WHERE nh.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
