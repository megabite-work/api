<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\CashboxDetail\RequestQueryDto;
use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashboxDetail>
 */
class CashboxDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashboxDetail::class);
    }

    public function findAllCashboxDetailsByCashbox(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $cashbox = $em->getReference(Cashbox::class, $dto->cashboxId);
        $qb = $this->createQueryBuilder('cd');

        $query = $qb
            ->select('cd', 'd', 'u', 'c', 'cp', 'cds')
            ->join('cd.user', 'u')
            ->join('cd.cashbox', 'c')
            ->leftJoin('cd.counterPart', 'cp')
            ->leftJoin('cd.cashboxDetails', 'cds')
            ->leftJoin('cd.detail', 'd')
            ->where('cd.cashbox = :cashbox')
            ->setParameter('cashbox', $cashbox);

        $query = $this->indexFilters($query, $dto);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    private function indexFilters(QueryBuilder $query, RequestQueryDto $dto): QueryBuilder
    {
        if ($dto->type) {
            $query->andWhere('cd.type = :type')->setParameter('type', $dto->type);
        }
        if ($dto->creditType) {
            $query->andWhere('cd.creditType = :creditType')->setParameter('creditType', $dto->creditType);
        }
        if (null !== $dto->returnStatus) {
            $query->andWhere('cd.returnStatus = :returnStatus')->setParameter('returnStatus', $dto->returnStatus);
        }
        if (null !== $dto->creditStatus) {
            $query->andWhere('cd.creditStatus = :creditStatus')->setParameter('creditStatus', $dto->creditStatus);
        }

        return $query;
    }

    public function findCashboxDetailByIdWithJoined(int $id): ?CashboxDetail
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT cd, u, c, cp, cds
            FROM App\Entity\CashboxDetail cd
            JOIN cd.user u
            JOIN cd.cashbox c
            LEFT JOIN cd.counterPart cp
            LEFT JOIN cd.cashboxDetails cds
            WHERE cd.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function getLastChequeNumberByCashbox(Cashbox $cashbox): ?int
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT cd.chequeNumber
            FROM App\Entity\CashboxDetail cd
            WHERE cd.cashbox = :cashbox
            ORDER BY cd.id DESC'
        )->setParameter('cashbox', $cashbox)
        ->setMaxResults(1);

        try {
            $chequeNumber = $query->getSingleScalarResult();

            return (int) $chequeNumber + 1;
        } catch (NoResultException|NonUniqueResultException $e) {
            return 1;
        }
    }
}
