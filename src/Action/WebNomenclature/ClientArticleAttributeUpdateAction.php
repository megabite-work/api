<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ClientArticleAttribute;
use App\Entity\MultiStore;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {
    }

    public function __invoke(int $multiStoreId, string $article, int $id, RequestDto $dto): ClientArticleAttribute
    {
        $multiStore = $this->em->find(MultiStore::class, $multiStoreId);
        $entity = $this->repo->findOneBy(['id' => $id, 'multiStore' => $multiStore, 'article' => $article]);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(ClientArticleAttribute $entity, RequestDto $dto): void
    {
        if ($dto->getAttributeUz() || $dto->getAttributeUzc() || $dto->getAttributeRu()) {
            $attributeName = $entity->getAttribute();
            $name = [
                'ru' => $dto->getAttributeRu() ?? $attributeName['ru'],
                'uz' => $dto->getAttributeUz() ?? $attributeName['uz'],
                'uzc' => $dto->getAttributeUzc() ?? $attributeName['uzc'],
            ];

            $entity->setAttribute($name);
        }
    }
}
