<?php

namespace App\Action\NomenclatureHistory;

use App\Action\StoreNomenclature\CreateOrUpdateAction;
use App\Component\EntityNotFoundException;
use App\Dto\NomenclatureHistory\RequestDto;
use App\Entity\ForgiveType;
use App\Entity\Nomenclature;
use App\Entity\NomenclatureHistory;
use App\Entity\Store;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CreateOrUpdateAction $createOrUpdateAction
    ) {
    }

    public function __invoke(RequestDto $dto, User $user): NomenclatureHistory
    {
        $store = $this->em->find(Store::class, $dto->getStoreId());
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $store || null === $nomenclature) {
            throw new EntityNotFoundException('store or nomenclature not found');
        }

        $nomenclatureHistory = $this->create($user, $nomenclature, $store, $dto);
        $this->createOrUpdateAction->__invoke($store, $nomenclature, $dto->getQty());

        $this->em->flush();

        return $nomenclatureHistory;
    }

    private function create(User $user, Nomenclature $nomenclature, Store $store, RequestDto $dto): NomenclatureHistory
    {
        $nomenclatureHistory = (new NomenclatureHistory())
            ->setOwner($user)
            ->setNomenclature($nomenclature)
            ->setStore($store)
            ->setQty($dto->getQty())
            ->setOldPrice($dto->getOldPrice() ?? 0)
            ->setPrice($dto->getPrice() ?? 0)
            ->setOldPriceCourse($dto->getOldPriceCourse() ?? 0)
            ->setPriceCourse($dto->getPriceCourse() ?? 0)
            ->setComment($dto->getComment());

        if ($dto->getForgiveTypeId()) {
            $forgiveType = $this->em->find(ForgiveType::class, $dto->getForgiveTypeId());
            $nomenclatureHistory->setForgiveType($forgiveType);
        }

        $this->em->persist($nomenclatureHistory);

        return $nomenclatureHistory;
    }
}
