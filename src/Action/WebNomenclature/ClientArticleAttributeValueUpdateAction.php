<?php

namespace App\Action\WebNomenclature;

use App\Component\EntityNotFoundException;
use App\Dto\WebNomenclature\RequestDto;
use App\Entity\ClientArticleAttributeValue;
use App\Entity\WebNomenclature;
use App\Repository\ClientArticleAttributeRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientArticleAttributeValueUpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientArticleAttributeRepository $repo
    ) {
    }

    public function __invoke(int $id, int $valueId, RequestDto $dto): ClientArticleAttributeValue
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $id);
        $entity = $this->repo->findOneBy(['id' => $valueId, 'webNomenclature' => $webNomenclature]);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->update($entity, $dto);
        $this->em->flush();

        return $entity;
    }

    private function update(ClientArticleAttributeValue $entity, RequestDto $dto): void
    {
        if ($dto->getValueUz() || $dto->getValueUzc() || $dto->getValueRu()) {
            $attributeName = $entity->getValue();
            $name = [
                'ru' => $dto->getValueRu() ?? $attributeName['ru'],
                'uz' => $dto->getValueUz() ?? $attributeName['uz'],
                'uzc' => $dto->getValueUzc() ?? $attributeName['uzc'],
            ];

            $entity->setValue($name);
        }
    }
}
