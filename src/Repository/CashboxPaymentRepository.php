<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\CashboxPayment\RequestQueryDto;
use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use App\Entity\CashboxPayment;
use App\Entity\PaymentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CashboxPayment>
 */
class CashboxPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashboxPayment::class);
    }

    public function findAllCashboxPaymentsWithJoined(RequestQueryDto $dto): Paginator
    {
        $qb = $this->getEntityManager();
        $cashboxDetail = $qb->find(CashboxDetail::class, $dto->cashboxDetailId);
        $paymentType = $qb->find(PaymentType::class, $dto->paymentTypeId);

        $query = $qb->createQuery(
            'SELECT cp, cd, pt
            FROM App\Entity\CashboxPayment cp
            JOIN cp.cashboxDetail cd
            JOIN cp.paymentType pt
            WHERE cp.cashboxDetail = :cashboxDetail AND cp.paymentType = :paymentType'
        )->setParameters(['cashboxDetail' => $cashboxDetail, 'paymentType' => $paymentType]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllCashboxPaymentsByCashboxDetail(RequestQueryDto $dto): Paginator
    {
        $qb = $this->getEntityManager();
        $cashboxDetail = $qb->find(CashboxDetail::class, $dto->cashboxDetailId);

        $query = $qb->createQuery(
            'SELECT cp, cd, pt
            FROM App\Entity\CashboxPayment cp
            JOIN cp.cashboxDetail cd
            JOIN cp.paymentType pt
            WHERE cp.cashboxDetail = :cashboxDetail'
        )->setParameters(['cashboxDetail' => $cashboxDetail]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllCashboxPaymentsByPaymentType(RequestQueryDto $dto): Paginator
    {
        $qb = $this->getEntityManager();
        $paymentType = $qb->find(PaymentType::class, $dto->paymentTypeId);
        $cashbox = $qb->find(Cashbox::class, $dto->cashboxId);

        $query = $qb->createQuery(
            'SELECT cp, cd, pt
            FROM App\Entity\CashboxPayment cp
            JOIN cp.cashboxDetail cd
            JOIN cp.paymentType pt
            WHERE cp.paymentType = :paymentType AND cd.cashbox = :cashbox'
        )->setParameters(['paymentType' => $paymentType, 'cashbox' => $cashbox]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findCashboxPaymentById(int $id): ?CashboxPayment
    {
        $qb = $this->getEntityManager();

        $query = $qb->createQuery(
            'SELECT cp, cd, pt
            FROM App\Entity\CashboxPayment cp
            JOIN cp.cashboxDetail cd
            JOIN cp.paymentType pt
            WHERE cp.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getOneOrNullResult();
    }
}
