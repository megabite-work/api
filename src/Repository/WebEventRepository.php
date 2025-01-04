<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebEvent\RequestQueryDto;
use App\Entity\WebEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebEvent>
 */
class WebEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebEvent::class);
    }

    public function findAllWebEventsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT we
            FROM App\Entity\WebEvent we
            WHERE we.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->getMultiStoreId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
