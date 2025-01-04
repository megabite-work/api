<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebFooterBody\RequestQueryDto;
use App\Entity\WebFooterBody;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebFooterBody>
 */
class WebFooterBodyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebFooterBody::class);
    }

    public function findAllWebFooterBodyByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wfb
            FROM App\Entity\WebFooterBody wfb
            WHERE wfb.webFooterId = :webFooterId'
        )->setParameters(['webFooterId' => $dto->getWebFooterId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
