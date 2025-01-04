<?php

namespace App\Action\Attribute;

use App\Entity\AttributeEntity;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class DetachAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, int $categoryId): void
    {
        $category = $this->em->getReference(Category::class, $categoryId);
        $attribute = $this->em->find(AttributeEntity::class, $id);
        $attribute->removeCategory($category);
        $this->em->flush();
    }
}
