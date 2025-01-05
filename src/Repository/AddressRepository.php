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
            ->setRegion($dto->region)
            ->setDistrict($dto->district)
            ->setStreet($dto->street)
            ->setHouse($dto->house)
            ->setLatitude($dto->longitude)
            ->setLongitude($dto->latitude);

        $this->getEntityManager()->persist($address);

        return $address;
    }

    public function checkAddressExistsAndUpdateOrCreate($entity, $dto): void
    {
        $address = $entity->getAddress();

        if (null === $address && $dto->region && $dto->district && $dto->street && $dto->house) {
            $address = $this->createAddress($dto);
            $entity->setAddress($address);
        } else {
            if ($dto->region) {
                $address->setRegion($dto->region);
            }
            if ($dto->district) {
                $address->setDistrict($dto->district);
            }
            if ($dto->street) {
                $address->setStreet($dto->street);
            }
            if ($dto->house) {
                $address->setHouse($dto->house);
            }
            if ($dto->longitude) {
                $address->setLongitude($dto->longitude);
            }
            if ($dto->latitude) {
                $address->setLatitude($dto->latitude);
            }
        }
    }
}
