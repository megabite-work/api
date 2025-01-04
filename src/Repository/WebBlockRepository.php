<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebBlock\RequestQueryDto;
use App\Entity\WebBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebBlock>
 */
class WebBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebBlock::class);
    }

    public function findAllWebBloksByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wb
            FROM App\Entity\WebBlock wb
            WHERE wb.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->getMultiStoreId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
