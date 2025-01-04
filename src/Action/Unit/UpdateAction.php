<?php

namespace App\Action\Unit;

use App\Component\EntityNotFoundException;
use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Unit
    {
        $unit = $this->update($id, $dto);

        $this->em->flush();

        return $unit;
    }

    private function update(int $id, RequestDto $dto): Unit
    {
        $unit = $this->em->find(Unit::class, $id);

        if (null === $unit) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $categoryName = $unit->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $categoryName['ru'],
                'uz' => $dto->getNameUz() ?? $categoryName['uz'],
                'uzc' => $dto->getNameUzc() ?? $categoryName['uzc'],
            ];
            $unit->setName($name);
        }
        if ($dto->getIcon()) {
            $unit->setIcon($dto->getIcon());
        }
        // if ($dto->getCode()) {
        //     $unit->setCode($dto->getCode());
        // }

        return $unit;
    }
}
