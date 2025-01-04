<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\UserCredential\RequestQueryDto;
use App\Entity\UserCredential;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<UserCredential>
 */
class UserCredentialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCredential::class);
    }

    public function findAllUserCredentials(UserInterface $user, RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT uc
            FROM App\Entity\UserCredential uc
            WHERE uc.owner = :user'
        )->setParameters(['user' => $user]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findUserCredentialByType(UserInterface $user, string $type): ?UserCredential
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT uc
            FROM App\Entity\UserCredential uc
            WHERE uc.owner = :user AND uc.type = :type'
        )
            ->setParameters(['user' => $user, 'type' => $type])
            ->setMaxResults(1);

        return $query->getOneOrNullResult();
    }
}
