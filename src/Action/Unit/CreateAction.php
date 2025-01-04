<?php

namespace App\Action\Unit;

use App\Component\EntityNotFoundException;
use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use App\Repository\UnitRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UnitRepository $unitRepository
    ) {
    }

    public function __invoke(array $dtos): array
    {
        $this->em->beginTransaction();
        $entities = [];

        try {
            foreach ($dtos as $dto) {
                $entity = $this->create($dto);
                $entities[] = $entity;
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new EntityNotFoundException($th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(RequestDto $dto): Unit
    {
        $unit = $this->unitRepository->findOneBy(['code' => $dto->getCode()]);

        if (!$unit) {
            $unit = (new Unit())
                ->setName($dto->getName())
                ->setCode($dto->getCode())
                ->setIcon($dto->getIcon());

            $this->em->persist($unit);
        }

        return $unit;
    }
}
