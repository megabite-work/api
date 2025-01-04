<?php

namespace App\Action\StoreNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\StoreNomenclature\RequestDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $storeId, array $dtos): array
    {
        $this->em->beginTransaction();
        $entities = [];

        try {
            foreach ($dtos as $dto) {
                $entity = $this->create($storeId, $dto);
                $entities[] = $entity;
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new EntityNotFoundException($th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(int $storeId, RequestDto $dto): StoreNomenclature
    {
        $store = $this->em->find(Store::class, $storeId);
        $nomenclature = $this->em->find(Nomenclature::class, $dto->getNomenclatureId());

        if (null === $store && null === $nomenclature) {
            throw new EntityNotFoundException('not found');
        }

        $storeNomenclature = (new StoreNomenclature())
            ->setStore($store)
            ->setNomenclature($nomenclature)
            ->setQty($dto->getQty());

        $this->em->persist($storeNomenclature);

        return $storeNomenclature;
    }
}
