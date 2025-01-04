<?php

namespace App\Action\Category;

use App\Dto\Category\IndexDto;
use App\Dto\Category\RequestDto;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $parent = $dto->parentId ? $this->em->getReference(Category::class, $dto->parentId) : null;
        $entity = (new Category())
            ->setName($dto->getName())
            ->setImage($dto->image)
            ->setParent($parent);

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
