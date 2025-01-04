<?php

namespace App\Repository;

use App\Entity\Nomenclature;
use App\Entity\Store;
use App\Entity\StoreNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StoreNomenclature>
 */
class StoreNomenclatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoreNomenclature::class);
    }

    public function findStoreNomenclatureByStoreAndNomenclature(Store $store, Nomenclature $nomenclature): ?StoreNomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT sn
            FROM App\Entity\StoreNomenclature sn
            WHERE sn.store = :store AND sn.nomenclature = :nomenclature'
        )->setParameters(['store' => $store, 'nomenclature' => $nomenclature]);

        return $query->getOneOrNullResult();
    }
}
