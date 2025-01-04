<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Dto\Attribute\RequestDto;
use App\Entity\AttributeEntity;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): IndexDto
    {
        $category = $this->em->getReference(Category::class, $dto->categoryId);
        $entity = (new AttributeEntity())
            ->setName($dto->getName())
            ->addCategory($category);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
