<?php

namespace App\Action\StoreNomenclature;

use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use App\Repository\StoreNomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateOrUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreNomenclatureRepository $repo
    ) {
    }

    public function __invoke(Store $store, Nomenclature $nomenclature, float $qty): void
    {
        $storeNomenclature = $this->repo->findStoreNomenclatureByStoreAndNomenclature($store, $nomenclature);

        if (null === $storeNomenclature) {
            $this->create($store, $nomenclature, $qty);
        } else {
            $this->update($storeNomenclature, $qty);
        }
    }

    private function create(Store $store, Nomenclature $nomenclature, float $qty)
    {
        $storeNomenclature = (new StoreNomenclature())
            ->setStore($store)
            ->setNomenclature($nomenclature)
            ->setQty($qty);

        $this->em->persist($storeNomenclature);
    }

    private function update(StoreNomenclature $storeNomenclature, float $qty)
    {
        $updatedQty = $storeNomenclature->getQty() + $qty;
        $storeNomenclature->setQty($updatedQty);
    }
}
