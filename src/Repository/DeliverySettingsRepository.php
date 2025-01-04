<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\DeliverySettings\RequestQueryDto;
use App\Entity\DeliverySettings;
use App\Entity\MultiStore;
use App\Entity\Region;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DeliverySettings>
 */
class DeliverySettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliverySettings::class);
    }

    public function findAllDeliverySettingsByStoreAndRegion(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $dto->storeId);
        $region = $em->getReference(Region::class, $dto->regionId);

        $query = $em->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store = :store AND ds.region = :region'
        )->setParameters(['store' => $store, 'region' => $region]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllDeliverySettingsByStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $dto->storeId);

        $query = $em->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store = :store'
        )->setParameters(['store' => $store]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllDeliverySettingsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
        $stores = $em->getRepository(Store::class)->findBy(['multiStore' => $multiStore]);

        $query = $em->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store IN (:stores)'
        )->setParameters(['stores' => $stores]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllDeliverySettingsByRegion(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $region = $em->getReference(Region::class, $dto->regionId);

        $query = $em->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.region = :region'
        )->setParameters(['region' => $region]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findDeliverySettingsByIdWithStoreAndRegion(int $id): ?DeliverySettings
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT ds, s, r
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getOneOrNullResult();
    }
}
