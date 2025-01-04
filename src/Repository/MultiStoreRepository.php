<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\MultiStore\RequestQueryDto;
use App\Entity\MultiStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<MultiStore>
 */
class MultiStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiStore::class);
    }

    public function findAllMultiStoresByOwnerWithPagination(UserInterface $user, RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT m, s, w
            FROM App\Entity\MultiStore m
            LEFT JOIN m.stores s
            LEFT JOIN s.workers w
            WHERE m.owner = :user'
        )->setParameter('user', $user);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findMultiStoreByIdWithAddressAndPhoneAndStore(int $id): ?MultiStore
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT m, a, p, s
            FROM App\Entity\MultiStore m
            LEFT JOIN m.stores s
            LEFT JOIN m.address a
            LEFT JOIN m.phones p
            WHERE m.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findMultiStoreByIdWithAddressAndPhones(int $id): ?MultiStore
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT m, a, p
            FROM App\Entity\MultiStore m
            LEFT JOIN m.address a
            LEFT JOIN m.phones p
            WHERE m.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findMultiStoreByIdWithWebCredential(int $id): ?MultiStore
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT m, wc
            FROM App\Entity\MultiStore m
            LEFT JOIN m.webCredential wc
            WHERE m.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
