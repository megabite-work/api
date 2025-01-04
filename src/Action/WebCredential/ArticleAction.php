<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {
    }

    public function __invoke(int $multiStoreId): array
    {
        $entity = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId);

        if (null === $entity || !$entity->getWebCredential()) {
            throw new EntityNotFoundException('not found');
        }

        $webCredential = $entity->getWebCredential();
        $article = $webCredential->getArticle();
        $webCredential->setArticle($article + 1);

        $this->em->flush();

        return compact('article');
    }
}
