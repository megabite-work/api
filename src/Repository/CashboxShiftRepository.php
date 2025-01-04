<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\CashboxShift\RequestQueryDto;
use App\Entity\Cashbox;
use App\Entity\CashboxShift;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashboxShift>
 */
class CashboxShiftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashboxShift::class);
    }

    public function findAllCashboxShiftsByCashbox(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $cashbox = $em->getReference(Cashbox::class, $dto->cashboxId);

        $query = $em->createQuery(
            'SELECT csh, u
            FROM App\Entity\CashboxShift csh
            JOIN csh.user u
            WHERE csh.cashbox = :cashbox'
        )->setParameter('cashbox', $cashbox);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findCashboxShiftById(int $id): ?CashboxShift
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT csh, u
            FROM App\Entity\CashboxShift csh
            JOIN csh.user u
            WHERE csh.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
