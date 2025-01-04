<?php

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Address>
 */
class AddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    public function createAddress($dto): Address
    {
        $address = (new Address())
            ->setRegion($dto->getRegion())
            ->setDistrict($dto->getDistrict())
            ->setStreet($dto->getStreet())
            ->setHouse($dto->getHouse())
            ->setLatitude($dto->getLatitude())
            ->setLongitude($dto->getLongitude());

        $this->getEntityManager()->persist($address);

        return $address;
    }

    public function checkAddressExistsAndUpdateOrCreate($entity, $dto): void
    {
        $address = $entity->getAddress();

        if (null === $address && $dto->getRegion() && $dto->getDistrict() && $dto->getStreet() && $dto->getHouse()) {
            $address = $this->createAddress($dto);
            $entity->setAddress($address);
        } else {
            if ($dto->getRegion()) {
                $address->setRegion($dto->getRegion());
            }
            if ($dto->getDistrict()) {
                $address->setDistrict($dto->getDistrict());
            }
            if ($dto->getStreet()) {
                $address->setStreet($dto->getStreet());
            }
            if ($dto->getHouse()) {
                $address->setHouse($dto->getHouse());
            }
            if ($dto->getLongitude()) {
                $address->setLongitude($dto->getLongitude());
            }
            if ($dto->getLatitude()) {
                $address->setLatitude($dto->getLatitude());
            }
        }
    }
}
