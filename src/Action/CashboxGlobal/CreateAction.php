<?php

namespace App\Action\CashboxGlobal;

use App\Dto\CashboxGlobal\IndexDto;
use App\Dto\CashboxGlobal\RequestDto;
use App\Entity\CashboxDetail;
use App\Entity\CashboxGlobal;
use App\Entity\Nomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): array
    {
        $entities = $this->create($dto);
        $this->em->flush();

        return $entities;
    }

    private function create(RequestDto $dto): array
    {
        $cashboxDetail = $this->em->getReference(CashboxDetail::class, $dto->cashboxDetailId);
        $entities = [];
        /** @var \App\Dto\CashboxGlobal\UpdateRequestDto $item */
        foreach ($dto->getItems() as $item) {
            $entity = (new CashboxGlobal())
                ->setCashboxDetail($cashboxDetail)
                ->setNomenclature($this->em->getReference(Nomenclature::class, $item->nomenclatureId))
                ->setQty($item->qty)
                ->setOldPrice($item->oldPrice)
                ->setPrice($item->price)
                ->setOldPriceCourse($item->oldPriceCourse)
                ->setPriceCourse($item->priceCourse)
                ->setNds($item->nds)
                ->setNdsSum($item->ndsSum)
                ->setDiscount($item->discount)
                ->setDiscountSum($item->discountSum);

            $this->em->persist($entity);
            $entities[] = IndexDto::fromEntity($entity);
        }

        return $entities;
    }
}
