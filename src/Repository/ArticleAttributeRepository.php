<?php

namespace App\Repository;

use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ArticleAttribute;
use App\Entity\MultiStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleAttribute>
 */
class ArticleAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleAttribute::class);
    }

    public function findByMultiStoreAndArticle(RequestDto $dto): ?ArticleAttribute
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\ArticleAttribute a
            WHERE a.multiStore = :multiStore AND a.article = :article'
        )->setParameters(['multiStore' => $multiStore, 'article' => $dto->getArticle()]);

        return $query->getOneOrNullResult();
    }
}
