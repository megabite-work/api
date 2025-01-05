<?php

namespace App\Action\Nomenclature;

use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestDto;
use App\Entity\Category;
use App\Entity\Nomenclature;
use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(Nomenclature::class, $id);
        $entity = $this->update($dto, $entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function update(RequestDto $dto, Nomenclature $entity): Nomenclature
    {
        $this->updateCategory($entity, $dto);
        $this->updateUnit($entity, $dto);

        $entity->setQrCode($dto->qrCode ?? $entity->getQrCode())
            ->setBarcode($dto->barcode ?? $entity->getBarcode())
            ->setMxik($dto->mxik ?? $entity->getMxik())
            ->setBrand($dto->brand ?? $entity->getBrand())
            ->setOldPrice($dto->oldPrice ?? $entity->getOldPrice())
            ->setPrice($dto->price  ?? $entity->getPrice())
            ->setOldPriceCourse($dto->oldPriceCourse ?? $entity->getOldPriceCourse())
            ->setPriceCourse($dto->priceCourse ?? $entity->getPriceCourse())
            ->setNds($dto->nds  ?? $entity->getNds())
            ->setName([
                'ru' => $dto->nameRu ?? $entity->getName()['ru'],
                'uz' => $dto->nameUz ?? $entity->getName()['uz'],
                'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
            ])
            ->setDiscount($dto->discount ?? $entity->getDiscount());


        return $entity;
    }

    private function updateCategory(Nomenclature $entity, RequestDto $dto): void
    {
        if ($dto->categoryId) {
            $entity->setCategory($this->em->getReference(Category::class, $dto->categoryId));
        }
    }

    private function updateUnit(Nomenclature $entity, RequestDto $dto): void
    {
        if ($dto->unitCode) {
            $entity->setUnit($this->em->getRepository(Unit::class)->findOneBy(['code' => $dto->unitCode]));
        }
    }
}
