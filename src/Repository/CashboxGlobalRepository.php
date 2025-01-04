<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\CashboxGlobal\RequestQueryDto;
use App\Entity\CashboxDetail;
use App\Entity\CashboxGlobal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashboxGlobal>
 */
class CashboxGlobalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashboxGlobal::class);
    }

    public function findAllCashboxGlobalsByCashboxDetail(RequestQueryDto $dto): Paginator
    {
        $qb = $this->getEntityManager();
        $cashboxDetail = $qb->find(CashboxDetail::class, $dto->cashboxDetailId);

        $query = $qb->createQuery(
            'SELECT cg, n
            FROM App\Entity\CashboxGlobal cg
            JOIN cg.nomenclature n
            WHERE cg.cashboxDetail = :cashboxDetail'
        )->setParameters(['cashboxDetail' => $cashboxDetail]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findCashboxGlobalById(int $id): ?CashboxGlobal
    {
        $qb = $this->getEntityManager();

        $query = $qb->createQuery(
            'SELECT cg, n
            FROM App\Entity\CashboxGlobal cg
            JOIN cg.nomenclature n
            WHERE cg.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getOneOrNullResult();
    }
}
