<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Entity\MultiStore;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeDeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {
    }

    public function __invoke(int $multiStoreId, string $article, int $id): bool
    {
        $multiStore = $this->em->find(MultiStore::class, $multiStoreId);
        $entity = $this->repo->findOneBy(['id' => $id, 'multiStore' => $multiStore, 'article' => $article]);

        if (null === $multiStore || null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }
}
