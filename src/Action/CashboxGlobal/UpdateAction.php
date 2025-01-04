<?php

namespace App\Action\CashboxGlobal;

use App\Dto\CashboxGlobal\IndexDto;
use App\Dto\CashboxGlobal\UpdateRequestDto;
use App\Repository\CashboxGlobalRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CashboxGlobalRepository $repo
    ) {}

    public function __invoke(int $id, UpdateRequestDto $dto): IndexDto
    {
        $entity = $this->repo->findCashboxGlobalById($id);
        $entity->setQty($dto->qty)
            ->setOldPrice($dto->oldPrice)
            ->setPrice($dto->price)
            ->setDiscount($dto->discount)
            ->setDiscountSum($dto->discountSum)
            ->setNds($dto->nds)
            ->setNdsSum($dto->ndsSum)
            ->setOldPriceCourse($dto->oldPriceCourse)
            ->setPriceCourse($dto->priceCourse);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
