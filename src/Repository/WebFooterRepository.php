<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebFooter\RequestQueryDto;
use App\Entity\WebFooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebFooter>
 */
class WebFooterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebFooter::class);
    }

    public function findAllWebFootersByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wf
            FROM App\Entity\WebFooter wf
            WHERE wf.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->getMultiStoreId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
