<?php

namespace App\Action\CashboxDetail;

use App\Component\CurrentUser;
use App\Dto\CashboxDetail\IndexDto;
use App\Dto\CashboxDetail\RequestDto;
use App\Entity\Cashbox;
use App\Entity\CashboxDetail;
use App\Entity\CounterPart;
use App\Repository\CashboxDetailRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxDetailRepository $repo,
        private CurrentUser $user
    ) {
    }

    public function __invoke(RequestDto $dto): IndexDto
    {
        $cashbox = $this->em->getReference(Cashbox::class, $dto->cashboxId);
        $chequeNumber = $this->repo->getLastChequeNumberByCashbox($cashbox);
        $entity = $this->create($cashbox, $dto, $chequeNumber);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function create(Cashbox $cashbox, RequestDto $dto, int $chequeNumber): CashboxDetail
    {
        $counterPart = $dto->counterPartId ? $this->em->getReference(CounterPart::class, $dto->counterPartId) : null;
        $detail = $dto->detailId ? $this->em->getReference(CashboxDetail::class, $dto->detailId) : null;
        $entity = (new CashboxDetail())
            ->setChequeNumber($chequeNumber)
            ->setType($dto->type)
            ->setReturnStatus($dto->returnStatus)
            ->setCreditStatus($dto->creditStatus)
            ->setCreditType($dto->creditType)
            ->setSale($dto->sale)
            ->setDiscount($dto->discount)
            ->setAdvance($dto->advance)
            ->setRemain($dto->remain)
            ->setNds($dto->nds)
            ->setSurrender($dto->surrender)
            ->setCredit($dto->credit)
            ->setCounterPart($counterPart)
            ->setDetail($detail)
            ->setUser($this->user->getUser())
            ->setCashbox($cashbox);
        $this->em->persist($entity);

        return $entity;
    }
}
