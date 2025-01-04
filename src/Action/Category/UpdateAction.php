<?php

namespace App\Action\Category;

use App\Dto\Category\IndexDto;
use App\Dto\Category\RequestDto;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CategoryRepository $repo
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->repo->findCategoryByIdWithParentAndChildrens($id);
        $entity = $this->update($entity, $dto);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function update(Category $entity, RequestDto $dto): Category
    {
        $this->updateName($entity, $dto);
        $this->updateParent($entity, $dto);
        $entity->setImage($dto->image ?? $entity->getImage());
        $entity->setIsActive($dto->isActive ?? $entity->getIsActive());

        return $entity;
    }

    private function updateName(Category $entity, RequestDto $dto): void
    {
        $entityName = $entity->getName();
        $name = [
            'ru' => $dto->nameRu ?? $entityName['ru'],
            'uz' => $dto->nameUz ?? $entityName['uz'],
            'uzc' => $dto->nameUzc ?? $entityName['uzc'],
        ];

        $entity->setName($name);
    }

    private function updateParent(Category $entity, RequestDto $dto): void
    {
        if ($dto->parentId && $dto->parentId !== $entity->getParentId()) {
            $entity->setParent($this->em->getReference(Category::class, $dto->parentId));
        }
    }
}
