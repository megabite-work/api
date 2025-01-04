<?php

namespace App\Action\StoreNomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $storeId, int $nomenclatureId): bool
    {
        $store = $this->em->find(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $nomenclatureId);
        $storeNomenclature = $this->em->getRepository(StoreNomenclature::class)->findOneBy(['store' => $store, 'nomenclature' => $nomenclature]);

        if (null === $storeNomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($storeNomenclature);
        $this->em->flush();

        return true;
    }
}
