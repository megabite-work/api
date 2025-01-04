<?php

namespace App\Repository;

use App\Entity\Phone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Phone>
 */
class PhoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Phone::class);
    }

    public function createPhone(string $phone): Phone
    {
        $phone = (new Phone())->setPhone($phone);

        $this->getEntityManager()->persist($phone);

        return $phone;
    }

    public function checkPhoneExistsAndCreate($entity, $phones): void
    {
        if (count($phones)) {
            $entityPhones = $entity->getPhones();

            foreach ($phones as $item) {
                if (count($entityPhones->filter(fn ($phone) => $phone->getPhone() === $item))) {
                    continue;
                }

                $newPhone = $this->createPhone($item);
                $entity->addPhone($newPhone);
            }
        }
    }
}
