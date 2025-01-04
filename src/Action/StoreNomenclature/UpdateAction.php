<?php

namespace App\Action\StoreNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\StoreNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $storeId, int $nomenclatureId, RequestDto $dto): Nomenclature
    {
        $store = $this->em->find(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $nomenclatureId);
        $storeNomenclature = $this->em->getRepository(StoreNomenclature::class)->findOneBy(['store' => $store, 'nomenclature' => $nomenclature]);

        if (null === $storeNomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $storeNomenclature = $this->updateStoreNomenclature($storeNomenclature, $dto);

        $this->em->flush();

        return $nomenclature;
    }

    private function updateStoreNomenclature(StoreNomenclature $storeNomenclature, RequestDto $dto)
    {
        if ($dto->getQty()) {
            $storeNomenclature->setQty($dto->getQty());
        }

        return $storeNomenclature;
    }
}
