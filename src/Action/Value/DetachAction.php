<?php

namespace App\Action\Value;

use App\Component\EntityNotFoundException;
use App\Entity\AttributeEntity;
use App\Entity\ValueEntity;
use App\Repository\AttributeValueRepository;
use Doctrine\ORM\EntityManagerInterface;

class DetachAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeValueRepository $repo
    ) {
    }

    public function __invoke(int $valueId, int $attributeId): bool
    {
        $value = $this->em->find(ValueEntity::class, $valueId);
        $attribute = $this->em->find(AttributeEntity::class, $attributeId);
        $entity = $this->repo->findOneBy(['attribute' => $attribute, 'value' => $value]);

        if (null === $value || null === $attribute || null === $entity) {
            throw new EntityNotFoundException('value or attribute not found');
        }

        try {
            $this->em->remove($entity);
            $this->em->flush();

            return true;
        } catch (\Throwable $th) {
            throw new EntityNotFoundException('remove failed', 500);
        }
    }
}
