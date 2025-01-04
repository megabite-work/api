<?php

namespace App\Action\Attribute;

use App\Entity\AttributeEntity;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $attributeId, int $categoryId): void
    {
        $category = $this->em->getReference(Category::class, $categoryId);
        $attribute = $this->em->find(AttributeEntity::class, $attributeId);
        $attribute->addCategory($category);
        $this->em->flush();
    }
}
