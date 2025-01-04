<?php

namespace App\Action\CashboxPayment;

use App\Dto\CashboxPayment\IndexDto;
use App\Dto\CashboxPayment\RequestDto;
use App\Entity\CashboxDetail;
use App\Entity\CashboxPayment;
use App\Entity\PaymentType;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $cashboxDetail = $this->em->getReference(CashboxDetail::class, $dto->cashboxDetailId);
        $paymentType = $this->em->getReference(PaymentType::class, $dto->paymentTypeId);
        $entity = (new CashboxPayment())
            ->setCashboxDetail($cashboxDetail)
            ->setPaymentType($paymentType)
            ->setAmount($dto->amount);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
