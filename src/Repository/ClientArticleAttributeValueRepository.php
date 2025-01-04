<?php

namespace App\Repository;

use App\Entity\ClientArticleAttributeValue;
use App\Entity\WebNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientArticleAttributeValue>
 */
class ClientArticleAttributeValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientArticleAttributeValue::class);
    }

    public function findAllByWebNomenclatureWithAttribute(WebNomenclature $webNomenclature): array
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT caav, a
            FROM App\Entity\ClientArticleAttributeValue caav
            JOIN caav.attribute a
            WHERE caav.webNomenclature = :webNomenclature'
        )->setParameter('webNomenclature', $webNomenclature);

        return $query->getResult();
    }
}
